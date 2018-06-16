<?php
declare (strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Register user
     * @test
     */
    public function success()
    {
        $name = 'John';
        $email = 'test@mail.com';
        $password = '123456';

        $response = $this->postJson(route('register'), [
            'name'  => $name,
            'email' => $email,
            'password' => $password
        ]);

        $user = User::whereEmail($email)->first();
        $this->assertNotNull($user);
        $this->assertEquals($name, $response->json('result.name'));
        $this->assertEquals($user->id, $response->json('result.id'));
        $this->assertEquals($email, $response->json('result.email'));
        $this->assertEquals(trans('auth.register'), $response->json('message'));
        $response->assertSuccessful();
    }
}