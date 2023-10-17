<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $userList = User::all();
        return new UserCollection($userList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        User::where('id', $user['id'])->update($validated);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }

    public function uploadAvatar(Request $request) {
        $file = $request->file('avatar')->store('public', 'hello.txt');
 
        return $file;
    }

    public function detail(string $id) {
        $info = User::where('id', $id)->with('avatar')->first();
        return new UserResource($info);
    }
}
