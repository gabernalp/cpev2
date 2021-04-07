<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEventsAttendantRequest;
use App\Http\Requests\StoreEventsAttendantRequest;
use App\Http\Requests\UpdateEventsAttendantRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\EventsAttendant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventsAttendantsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('events_attendant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventsAttendant::with(['department', 'city'])->select(sprintf('%s.*', (new EventsAttendant)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'events_attendant_show';
                $editGate      = 'events_attendant_edit';
                $deleteGate    = 'events_attendant_delete';
                $crudRoutePart = 'events-attendants';

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
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('documenttype', function ($row) {
                return $row->documenttype ? $row->documenttype : "";
            });
            $table->editColumn('document', function ($row) {
                return $row->document ? $row->document : "";
            });
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('entity', function ($row) {
                return $row->entity ? EventsAttendant::ENTITY_SELECT[$row->entity] : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'department', 'city']);

            return $table->make(true);
        }

        return view('admin.eventsAttendants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('events_attendant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventsAttendants.create', compact('departments', 'cities'));
    }

    public function store(StoreEventsAttendantRequest $request)
    {
        $eventsAttendant = EventsAttendant::create($request->all());

        return redirect()->route('admin.events-attendants.index');
    }

    public function edit(EventsAttendant $eventsAttendant)
    {
        abort_if(Gate::denies('events_attendant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventsAttendant->load('department', 'city');

        return view('admin.eventsAttendants.edit', compact('departments', 'cities', 'eventsAttendant'));
    }

    public function update(UpdateEventsAttendantRequest $request, EventsAttendant $eventsAttendant)
    {
        $eventsAttendant->update($request->all());

        return redirect()->route('admin.events-attendants.index');
    }

    public function show(EventsAttendant $eventsAttendant)
    {
        abort_if(Gate::denies('events_attendant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventsAttendant->load('department', 'city');

        return view('admin.eventsAttendants.show', compact('eventsAttendant'));
    }

    public function destroy(EventsAttendant $eventsAttendant)
    {
        abort_if(Gate::denies('events_attendant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventsAttendant->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventsAttendantRequest $request)
    {
        EventsAttendant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
