<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPointsRuleRequest;
use App\Http\Requests\StorePointsRuleRequest;
use App\Http\Requests\UpdatePointsRuleRequest;
use App\Models\PointsRule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointsRulesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('points_rule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointsRule::query()->select(sprintf('%s.*', (new PointsRule)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'points_rule_show';
                $editGate      = 'points_rule_edit';
                $deleteGate    = 'points_rule_delete';
                $crudRoutePart = 'points-rules';

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
            $table->editColumn('points_item', function ($row) {
                return $row->points_item ? $row->points_item : "";
            });
            $table->editColumn('points', function ($row) {
                return $row->points ? $row->points : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pointsRules.index');
    }

    public function create()
    {
        abort_if(Gate::denies('points_rule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointsRules.create');
    }

    public function store(StorePointsRuleRequest $request)
    {
        $pointsRule = PointsRule::create($request->all());

        return redirect()->route('admin.points-rules.index');
    }

    public function edit(PointsRule $pointsRule)
    {
        abort_if(Gate::denies('points_rule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointsRules.edit', compact('pointsRule'));
    }

    public function update(UpdatePointsRuleRequest $request, PointsRule $pointsRule)
    {
        $pointsRule->update($request->all());

        return redirect()->route('admin.points-rules.index');
    }

    public function show(PointsRule $pointsRule)
    {
        abort_if(Gate::denies('points_rule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointsRules.show', compact('pointsRule'));
    }

    public function destroy(PointsRule $pointsRule)
    {
        abort_if(Gate::denies('points_rule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointsRule->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointsRuleRequest $request)
    {
        PointsRule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
