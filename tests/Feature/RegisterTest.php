<?php
declare (strict_types = 1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RegisterTest
 * @package Tests\Feature
 */
class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->seed(\LaratrustSeeder::class);
    }


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
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password
        ]);

        $user = User::whereEmail($email)->first();
        $this->assertNotNull($user);
        $this->assertEquals($name, $response->json('data.name'));
        $this->assertEquals($user->id, $response->json('data.id'));
        $this->assertEquals($email, $response->json('data.email'));
        $this->assertEquals(trans('auth.register'), $response->json('message'));
        $response->assertSuccessful();
        $response->assertHeader('authorization');
    }

    /**
     * @param $params
     * @param $errors
     *
     * @test
     * @dataProvider providerValidation
     */
    public function validation($params, $errors)
    {
        $this->postJson(route('register'), $params)
            ->assertJsonValidationErrors($errors);
    }

    public function providerValidation()
    {
        return [
            'required email'     => [
                ['name' => 'John', 'password' => '123456', 'password_confirmation' => '123456'],
                ['email']
            ],
            'invalid email'      => [
                ['name' => 'John', 'password' => '123456', 'password_confirmation' => '123456', 'email' => 'test'],
                ['email']
            ],
            'required name'      => [
                ['email' => 'test@mail.com', 'password' => '123456', 'password_confirmation' => '123456'],
                ['name']
            ],
            'required password'  => [
                ['email' => 'test@mail.com', 'name' => 'John', 'password_confirmation' => '123456'],
                ['password']
            ],
            'confirmed password' => [
                ['email' => 'test@mail.com', 'name' => 'John', 'password_confirmation' => '123456'],
                ['password']
            ],
        ];
    }
}