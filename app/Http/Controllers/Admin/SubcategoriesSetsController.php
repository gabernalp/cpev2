<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySubcategoriesSetRequest;
use App\Http\Requests\StoreSubcategoriesSetRequest;
use App\Http\Requests\UpdateSubcategoriesSetRequest;
use App\Models\ResourcesCategory;
use App\Models\ResourcesSubcategory;
use App\Models\SubcategoriesSet;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubcategoriesSetsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('subcategories_set_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubcategoriesSet::with(['resourcescategory', 'resourcessubcategory'])->select(sprintf('%s.*', (new SubcategoriesSet)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'subcategories_set_show';
                $editGate      = 'subcategories_set_edit';
                $deleteGate    = 'subcategories_set_delete';
                $crudRoutePart = 'subcategories-sets';

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

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'resourcescategory', 'resourcessubcategory']);

            return $table->make(true);
        }

        return view('admin.subcategoriesSets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('subcategories_set_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resourcescategories = ResourcesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resourcessubcategories = ResourcesSubcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subcategoriesSets.create', compact('resourcescategories', 'resourcessubcategories'));
    }

    public function store(StoreSubcategoriesSetRequest $request)
    {
        $subcategoriesSet = SubcategoriesSet::create($request->all());

        return redirect()->route('admin.subcategories-sets.index');
    }

    public function edit(SubcategoriesSet $subcategoriesSet)
    {
        abort_if(Gate::denies('subcategories_set_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resourcescategories = ResourcesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resourcessubcategories = ResourcesSubcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategoriesSet->load('resourcescategory', 'resourcessubcategory');

        return view('admin.subcategoriesSets.edit', compact('resourcescategories', 'resourcessubcategories', 'subcategoriesSet'));
    }

    public function update(UpdateSubcategoriesSetRequest $request, SubcategoriesSet $subcategoriesSet)
    {
        $subcategoriesSet->update($request->all());

        return redirect()->route('admin.subcategories-sets.index');
    }

    public function show(SubcategoriesSet $subcategoriesSet)
    {
        abort_if(Gate::denies('subcategories_set_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategoriesSet->load('resourcescategory', 'resourcessubcategory', 'subcategoriessetResources');

        return view('admin.subcategoriesSets.show', compact('subcategoriesSet'));
    }

    public function destroy(SubcategoriesSet $subcategoriesSet)
    {
        abort_if(Gate::denies('subcategories_set_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategoriesSet->delete();

        return back();
    }

    public function massDestroy(MassDestroySubcategoriesSetRequest $request)
    {
        SubcategoriesSet::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
