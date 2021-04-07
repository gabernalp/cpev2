<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Entity;
use App\Models\Operator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contract::with(['operator', 'entities'])->select(sprintf('%s.*', (new Contract)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contract_show';
                $editGate      = 'contract_edit';
                $deleteGate    = 'contract_delete';
                $crudRoutePart = 'contracts';

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

            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : "";
            });
            $table->addColumn('operator_name', function ($row) {
                return $row->operator ? $row->operator->name : '';
            });

            $table->editColumn('entity', function ($row) {
                $labels = [];

                foreach ($row->entities as $entity) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $entity->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'operator', 'entity']);

            return $table->make(true);
        }

        return view('admin.contracts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operators = Operator::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id');

        return view('admin.contracts.create', compact('operators', 'entities'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());
        $contract->entities()->sync($request->input('entities', []));

        return redirect()->route('admin.contracts.index');
    }

    public function edit(Contract $contract)
    {
        abort_if(Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operators = Operator::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id');

        $contract->load('operator', 'entities');

        return view('admin.contracts.edit', compact('operators', 'entities', 'contract'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());
        $contract->entities()->sync($request->input('entities', []));

        return redirect()->route('admin.contracts.index');
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->load('operator', 'entities');

        return view('admin.contracts.show', compact('contract'));
    }

    public function destroy(Contract $contract)
    {
        abort_if(Gate::denies('contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractRequest $request)
    {
        Contract::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
