<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOperatorRequest;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\Operator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OperatorsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('operator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Operator::query()->select(sprintf('%s.*', (new Operator)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'operator_show';
                $editGate      = 'operator_edit';
                $deleteGate    = 'operator_delete';
                $crudRoutePart = 'operators';

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
            $table->editColumn('nit', function ($row) {
                return $row->nit ? $row->nit : "";
            });
            $table->editColumn('observaciones', function ($row) {
                return $row->observaciones ? $row->observaciones : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.operators.index');
    }

    public function create()
    {
        abort_if(Gate::denies('operator_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.operators.create');
    }

    public function store(StoreOperatorRequest $request)
    {
        $operator = Operator::create($request->all());

        return redirect()->route('admin.operators.index');
    }

    public function edit(Operator $operator)
    {
        abort_if(Gate::denies('operator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.operators.edit', compact('operator'));
    }

    public function update(UpdateOperatorRequest $request, Operator $operator)
    {
        $operator->update($request->all());

        return redirect()->route('admin.operators.index');
    }

    public function show(Operator $operator)
    {
        abort_if(Gate::denies('operator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->load('operatorUsers', 'operatorContracts', 'operatorsCourses');

        return view('admin.operators.show', compact('operator'));
    }

    public function destroy(Operator $operator)
    {
        abort_if(Gate::denies('operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $operator->delete();

        return back();
    }

    public function massDestroy(MassDestroyOperatorRequest $request)
    {
        Operator::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
