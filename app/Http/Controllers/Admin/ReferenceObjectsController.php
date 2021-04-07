<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReferenceObjectRequest;
use App\Http\Requests\StoreReferenceObjectRequest;
use App\Http\Requests\UpdateReferenceObjectRequest;
use App\Models\ReferenceObject;
use App\Models\ReferenceType;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReferenceObjectsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reference_object_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReferenceObject::with(['referencetype', 'tags'])->select(sprintf('%s.*', (new ReferenceObject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'reference_object_show';
                $editGate      = 'reference_object_edit';
                $deleteGate    = 'reference_object_delete';
                $crudRoutePart = 'reference-objects';

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
            $table->addColumn('referencetype_name', function ($row) {
                return $row->referencetype ? $row->referencetype->name : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : "";
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('image', function ($row) {
                return $row->image ? $row->image : "";
            });
            $table->editColumn('tags', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'referencetype', 'file', 'tags']);

            return $table->make(true);
        }

        $reference_types = ReferenceType::get();
        $tags            = Tag::get();

        return view('admin.referenceObjects.index', compact('reference_types', 'tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('reference_object_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        return view('admin.referenceObjects.create', compact('referencetypes', 'tags'));
    }

    public function store(StoreReferenceObjectRequest $request)
    {
        $referenceObject = ReferenceObject::create($request->all());
        $referenceObject->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            $referenceObject->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $referenceObject->id]);
        }

        return redirect()->route('admin.reference-objects.index');
    }

    public function edit(ReferenceObject $referenceObject)
    {
        abort_if(Gate::denies('reference_object_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referencetypes = ReferenceType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        $referenceObject->load('referencetype', 'tags');

        return view('admin.referenceObjects.edit', compact('referencetypes', 'tags', 'referenceObject'));
    }

    public function update(UpdateReferenceObjectRequest $request, ReferenceObject $referenceObject)
    {
        $referenceObject->update($request->all());
        $referenceObject->tags()->sync($request->input('tags', []));

        if ($request->input('file', false)) {
            if (!$referenceObject->file || $request->input('file') !== $referenceObject->file->file_name) {
                if ($referenceObject->file) {
                    $referenceObject->file->delete();
                }

                $referenceObject->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($referenceObject->file) {
            $referenceObject->file->delete();
        }

        return redirect()->route('admin.reference-objects.index');
    }

    public function show(ReferenceObject $referenceObject)
    {
        abort_if(Gate::denies('reference_object_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referenceObject->load('referencetype', 'tags', 'referencesCourses');

        return view('admin.referenceObjects.show', compact('referenceObject'));
    }

    public function destroy(ReferenceObject $referenceObject)
    {
        abort_if(Gate::denies('reference_object_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referenceObject->delete();

        return back();
    }

    public function massDestroy(MassDestroyReferenceObjectRequest $request)
    {
        ReferenceObject::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('reference_object_create') && Gate::denies('reference_object_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ReferenceObject();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
