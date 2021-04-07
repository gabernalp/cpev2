<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBadgesUserRequest;
use App\Http\Requests\UpdateBadgesUserRequest;
use App\Http\Resources\Admin\BadgesUserResource;
use App\Models\BadgesUser;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BadgesUsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('badges_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BadgesUserResource(BadgesUser::with(['programmed_course', 'user', 'badge', 'created_by'])->get());
    }

    public function store(StoreBadgesUserRequest $request)
    {
        $badgesUser = BadgesUser::create($request->all());

        return (new BadgesUserResource($badgesUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BadgesUser $badgesUser)
    {
        abort_if(Gate::denies('badges_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BadgesUserResource($badgesUser->load(['programmed_course', 'user', 'badge', 'created_by']));
    }

    public function update(UpdateBadgesUserRequest $request, BadgesUser $badgesUser)
    {
        $badgesUser->update($request->all());

        return (new BadgesUserResource($badgesUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BadgesUser $badgesUser)
    {
        abort_if(Gate::denies('badges_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $badgesUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
