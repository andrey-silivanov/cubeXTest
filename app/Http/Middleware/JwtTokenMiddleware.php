<?php
declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Exceptions\JwtAuthFailedException;
use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use Tymon\JWTAuth\{
    Exceptions\JWTException,
    Exceptions\TokenExpiredException,
    JWTAuth
};

/**
 * Class JwtTokenMiddleware
 * @package App\Http\Middleware
 */
class JwtTokenMiddleware
{
    protected $events;
    protected $auth;

    /**
     * JwtTokenMiddleware constructor.
     * @param Dispatcher $events
     * @param JWTAuth $auth
     */
    public function __construct(Dispatcher $events, JWTAuth $auth)
    {
        $this->events = $events;
        $this->auth = $auth;
    }
    
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws JWTException
     * @throws JwtAuthFailedException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            throw new JwtAuthFailedException('tymon.jwt.absent');
        }
        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            throw new JwtAuthFailedException('tymon.jwt.expired');
        } catch (JWTException $e) {
            throw new JwtAuthFailedException('tymon.jwt.invalid');
        }
        if (!$user) {
            throw new JwtAuthFailedException('tymon.jwt.user_not_found');
        }
        $this->events->dispatch('tymon.jwt.valid', $user);

        return $next($request);
    }
}
