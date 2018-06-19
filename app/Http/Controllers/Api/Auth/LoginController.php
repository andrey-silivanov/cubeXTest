<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController,
    App\Http\Resources\UserResource,
    App\Models\User,
    Illuminate\Foundation\Auth\AuthenticatesUsers,
    Illuminate\Http\Request,
    Tymon\JWTAuth\Facades\JWTAuth,
    Illuminate\Http\JsonResponse,
    Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Auth
 */
class LoginController extends ApiController
{
    use AuthenticatesUsers;

    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            return $this->authenticated(auth()->user());
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticated(User $user): JsonResponse
    {
        return $this->noContentResponse([
            'Authorization' => JWTAuth::fromUser($user)
        ]);
    }

    /**
     * Return Auth user
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        $user = User::findOrFail(Auth::user()->id);

        return $this->successResponse(
            $this->transformDataForResponse(new UserResource($user)), trans('auth.login')
        );
    }

    /**
     * Refresh and check token
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->noContentResponse();
    }

    /**
     * Logout
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate();

        return $this->noContentResponse();
    }
}
