<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBadgeRequest;
use App\Http\Requests\StoreBadgeRequest;
use App\Http\Requests\UpdateBadgeRequest;
use App\Models\Badge;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BadgesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('badge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Badge::query()->select(sprintf('%s.*', (new Badge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'badge_show';
                $editGate      = 'badge_edit';
                $deleteGate    = 'badge_delete';
                $crudRoutePart = 'badges';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('points', function ($row) {
                return $row->points ? $row->points : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.badges.index');
    }

    public function create()
    {
        abort_if(Gate::denies('badge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.badges.create');
    }

    public function store(StoreBadgeRequest $request)
    {
        $badge = Badge::create($request->all());

        if ($request->input('image', false)) {
            $badge->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $badge->id]);
        }

        return redirect()->route('admin.badges.index');
    }

    public function edit(Badge $badge)
    {
        abort_if(Gate::denies('badge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.badges.edit', compact('badge'));
    }

    public function update(UpdateBadgeRequest $request, Badge $badge)
    {
        $badge->update($request->all());

        if ($request->input('image', false)) {
            if (!$badge->image || $request->input('image') !== $badge->image->file_name) {
                if ($badge->image) {
                    $badge->image->delete();
                }

                $badge->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($badge->image) {
            $badge->image->delete();
        }

        return redirect()->route('admin.badges.index');
    }

    public function show(Badge $badge)
    {
        abort_if(Gate::denies('badge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.badges.show', compact('badge'));
    }

    public function destroy(Badge $badge)
    {
        abort_if(Gate::denies('badge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $badge->delete();

        return back();
    }

    public function massDestroy(MassDestroyBadgeRequest $request)
    {
        Badge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('badge_create') && Gate::denies('badge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Badge();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
