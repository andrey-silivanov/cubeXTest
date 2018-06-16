<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Api\Auth
 */
class RegisterController extends ApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $user = $this->createUser($request->only('name', 'email', 'password'));
        $token = \JWTAuth::fromUser($user);

        return $this->successResponse(
            $this->transformDataForResponse(new UserResource($user)), trans('auth.register'),
                ['access_token' => $token]
            );
    }

    /**
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
}
