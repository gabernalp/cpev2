<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResourceRequest;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\Resource;
use App\Models\ResourcesCategory;
use App\Models\ResourcesSubcategory;
use App\Models\SubcategoriesSet;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResourcesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Resource::with(['resourcescategory', 'resourcessubcategory', 'subcategoriesset'])->select(sprintf('%s.*', (new Resource)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'resource_show';
                $editGate      = 'resource_edit';
                $deleteGate    = 'resource_delete';
                $crudRoutePart = 'resources';

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
            $table->addColumn('resourcescategory_name', function ($row) {
                return $row->resourcescategory ? $row->resourcescategory->name : '';
            });

            $table->addColumn('resourcessubcategory_name', function ($row) {
                return $row->resourcessubcategory ? $row->resourcessubcategory->name : '';
            });

            $table->addColumn('subcategoriesset_name', function ($row) {
                return $row->subcategoriesset ? $row->subcategoriesset->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'resourcescategory', 'resourcessubcategory', 'subcategoriesset', 'file']);

            return $table->make(true);
        }

        return view('admin.resources.index');
    }

    public function create()
    {
        abort_if(Gate::denies('resource_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resourcescategories = ResourcesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resourcessubcategories = ResourcesSubcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategoriessets = SubcategoriesSet::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resources.create', compact('resourcescategories', 'resourcessubcategories', 'subcategoriessets'));
    }

    public function store(StoreResourceRequest $request)
    {
        $resource = Resource::create($request->all());

        if ($request->input('file', false)) {
            $resource->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $resource->id]);
        }

        return redirect()->route('admin.resources.index');
    }

    public function edit(Resource $resource)
    {
        abort_if(Gate::denies('resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resourcescategories = ResourcesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resourcessubcategories = ResourcesSubcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategoriessets = SubcategoriesSet::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resource->load('resourcescategory', 'resourcessubcategory', 'subcategoriesset');

        return view('admin.resources.edit', compact('resourcescategories', 'resourcessubcategories', 'subcategoriessets', 'resource'));
    }

    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $resource->update($request->all());

        if ($request->input('file', false)) {
            if (!$resource->file || $request->input('file') !== $resource->file->file_name) {
                if ($resource->file) {
                    $resource->file->delete();
                }

                $resource->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($resource->file) {
            $resource->file->delete();
        }

        return redirect()->route('admin.resources.index');
    }

    public function show(Resource $resource)
    {
        abort_if(Gate::denies('resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resource->load('resourcescategory', 'resourcessubcategory', 'subcategoriesset');

        return view('admin.resources.show', compact('resource'));
    }

    public function destroy(Resource $resource)
    {
        abort_if(Gate::denies('resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resource->delete();

        return back();
    }

    public function massDestroy(MassDestroyResourceRequest $request)
    {
        Resource::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('resource_create') && Gate::denies('resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Resource();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
