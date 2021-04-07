<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserChainBlockRequest;
use App\Http\Requests\UpdateUserChainBlockRequest;
use App\Http\Resources\Admin\UserChainBlockResource;
use App\Models\UserChainBlock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserChainBlocksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_chain_block_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserChainBlockResource(UserChainBlock::with(['user', 'referencetype'])->get());
    }

    public function store(StoreUserChainBlockRequest $request)
    {
        $userChainBlock = UserChainBlock::create($request->all());

        return (new UserChainBlockResource($userChainBlock))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserChainBlock $userChainBlock)
    {
        abort_if(Gate::denies('user_chain_block_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserChainBlockResource($userChainBlock->load(['user', 'referencetype']));
    }

    public function update(UpdateUserChainBlockRequest $request, UserChainBlock $userChainBlock)
    {
        $userChainBlock->update($request->all());

        return (new UserChainBlockResource($userChainBlock))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserChainBlock $userChainBlock)
    {
        abort_if(Gate::denies('user_chain_block_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChainBlock->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
