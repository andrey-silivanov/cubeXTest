<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{
    public function register(Request $request)
    {
        $user = $this->createUser($request->only('name', 'email', 'password'));
        
        return $this->successResponse(
            $this->transformDataForResponse(new UserResource($user)), trans('auth.register'));
    }

    protected function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
}
