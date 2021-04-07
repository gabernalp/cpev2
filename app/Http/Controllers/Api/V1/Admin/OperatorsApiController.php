<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Http\Resources\Admin\OperatorResource;
use App\Models\Operator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperatorsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('operator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperatorResource(Operator::all());
    }

    public function store(StoreOperatorRequest $request)
    {
        $operator = Operator::create($request->all());

        return (new OperatorResource($operator))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Operator $operator)
    {
        abort_if(Gate::denies('operator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OperatorResource($operator);
    }

    public function update(UpdateOperatorRequest $request, Operator $operator)
    {
        $operator->update($request->all());

        return (new OperatorResource($operator))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Operator $operator)
    {
        abort_if(Gate::denies('operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
