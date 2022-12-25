<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['index','show']);
    }

    public function index()
    {
        $users = User::paginate(config('todosettings.paginate.user'));
             return response()->apiResult(
                 __('messages.method.index', ['name' => __('values.users')]), [
                 'users' => UserResource::collection($users),
                 'links' => UserResource::collection($users)->response()->getData()->links,
                 'meta' => UserResource::collection($users)->response()->getData()->meta,
             ]);
    }

    public function show(User $user)
    {
        return response()->apiResult(
            __('messages.method.show', ['name' => __('values.user')]),
            ['user' => new UserResource($user)]
        );
    }

    public function update(UserRequest $request, User $user)
    {
        $user->updateUser($request->only('name', 'description', 'category_id', 'execution_time'));
        return response()->apiResult(
            __('messages.method.update', ['name' => __('values.user')]),
            ['task' => new UserResource($user)]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
