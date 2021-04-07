<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubcategoriesSetRequest;
use App\Http\Requests\UpdateSubcategoriesSetRequest;
use App\Http\Resources\Admin\SubcategoriesSetResource;
use App\Models\SubcategoriesSet;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubcategoriesSetsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('subcategories_set_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubcategoriesSetResource(SubcategoriesSet::with(['resourcescategory', 'resourcessubcategory'])->get());
    }

    public function store(StoreSubcategoriesSetRequest $request)
    {
        $subcategoriesSet = SubcategoriesSet::create($request->all());

        return (new SubcategoriesSetResource($subcategoriesSet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubcategoriesSet $subcategoriesSet)
    {
        abort_if(Gate::denies('subcategories_set_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubcategoriesSetResource($subcategoriesSet->load(['resourcescategory', 'resourcessubcategory']));
    }

    public function update(UpdateSubcategoriesSetRequest $request, SubcategoriesSet $subcategoriesSet)
    {
        $subcategoriesSet->update($request->all());

        return (new SubcategoriesSetResource($subcategoriesSet))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubcategoriesSet $subcategoriesSet)
    {
        abort_if(Gate::denies('subcategories_set_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategoriesSet->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
