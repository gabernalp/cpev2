<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFeedbackTypeRequest;
use App\Http\Requests\StoreFeedbackTypeRequest;
use App\Http\Requests\UpdateFeedbackTypeRequest;
use App\Models\FeedbackType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeedbackTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('feedback_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeedbackType::query()->select(sprintf('%s.*', (new FeedbackType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'feedback_type_show';
                $editGate      = 'feedback_type_edit';
                $deleteGate    = 'feedback_type_delete';
                $crudRoutePart = 'feedback-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.feedbackTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('feedback_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbackTypes.create');
    }

    public function store(StoreFeedbackTypeRequest $request)
    {
        $feedbackType = FeedbackType::create($request->all());

        return redirect()->route('admin.feedback-types.index');
    }

    public function edit(FeedbackType $feedbackType)
    {
        abort_if(Gate::denies('feedback_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbackTypes.edit', compact('feedbackType'));
    }

    public function update(UpdateFeedbackTypeRequest $request, FeedbackType $feedbackType)
    {
        $feedbackType->update($request->all());

        return redirect()->route('admin.feedback-types.index');
    }

    public function show(FeedbackType $feedbackType)
    {
        abort_if(Gate::denies('feedback_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbackTypes.show', compact('feedbackType'));
    }

    public function destroy(FeedbackType $feedbackType)
    {
        abort_if(Gate::denies('feedback_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackType->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedbackTypeRequest $request)
    {
        FeedbackType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
