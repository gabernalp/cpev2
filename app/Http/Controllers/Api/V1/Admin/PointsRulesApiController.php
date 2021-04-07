<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointsRuleRequest;
use App\Http\Requests\UpdatePointsRuleRequest;
use App\Http\Resources\Admin\PointsRuleResource;
use App\Models\PointsRule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointsRulesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('points_rule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointsRuleResource(PointsRule::all());
    }

    public function store(StorePointsRuleRequest $request)
    {
        $pointsRule = PointsRule::create($request->all());

        return (new PointsRuleResource($pointsRule))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PointsRule $pointsRule)
    {
        abort_if(Gate::denies('points_rule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointsRuleResource($pointsRule);
    }

    public function update(UpdatePointsRuleRequest $request, PointsRule $pointsRule)
    {
        $pointsRule->update($request->all());

        return (new PointsRuleResource($pointsRule))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PointsRule $pointsRule)
    {
        abort_if(Gate::denies('points_rule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointsRule->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
