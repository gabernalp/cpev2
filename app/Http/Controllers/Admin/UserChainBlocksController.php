<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserChainBlockRequest;
use App\Http\Requests\StoreUserChainBlockRequest;
use App\Http\Requests\UpdateUserChainBlockRequest;
use App\Models\UserChainBlock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserChainBlocksController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_chain_block_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserChainBlock::with(['user', 'referencetype'])->select(sprintf('%s.*', (new UserChainBlock)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_chain_block_show';
                $editGate      = 'user_chain_block_edit';
                $deleteGate    = 'user_chain_block_delete';
                $crudRoutePart = 'user-chain-blocks';

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
            $table->addColumn('user_phone', function ($row) {
                return $row->user ? $row->user->phone : '';
            });

            $table->editColumn('user.document', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->document) : '';
            });
            $table->addColumn('referencetype_name', function ($row) {
                return $row->referencetype ? $row->referencetype->name : '';
            });

            $table->editColumn('media', function ($row) {
                return $row->media ? $row->media : "";
            });
            $table->editColumn('text', function ($row) {
                return $row->text ? $row->text : "";
            });
            $table->editColumn('broker', function ($row) {
                return $row->broker ? $row->broker : "";
            });
            $table->editColumn('id_mensaje', function ($row) {
                return $row->id_mensaje ? $row->id_mensaje : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'referencetype']);

            return $table->make(true);
        }

        return view('admin.userChainBlocks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_chain_block_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userChainBlocks.create');
    }

    public function store(StoreUserChainBlockRequest $request)
    {
        $userChainBlock = UserChainBlock::create($request->all());

        return redirect()->route('admin.user-chain-blocks.index');
    }

    public function edit(UserChainBlock $userChainBlock)
    {
        abort_if(Gate::denies('user_chain_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChainBlock->load('user', 'referencetype');

        return view('admin.userChainBlocks.edit', compact('userChainBlock'));
    }

    public function update(UpdateUserChainBlockRequest $request, UserChainBlock $userChainBlock)
    {
        $userChainBlock->update($request->all());

        return redirect()->route('admin.user-chain-blocks.index');
    }

    public function show(UserChainBlock $userChainBlock)
    {
        abort_if(Gate::denies('user_chain_block_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChainBlock->load('user', 'referencetype');

        return view('admin.userChainBlocks.show', compact('userChainBlock'));
    }

    public function destroy(UserChainBlock $userChainBlock)
    {
        abort_if(Gate::denies('user_chain_block_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChainBlock->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserChainBlockRequest $request)
    {
        UserChainBlock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
