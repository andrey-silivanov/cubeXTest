<?php
declare (strict_types = 1);

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User,
    Illuminate\Foundation\Testing\RefreshDatabase,
    Tests\TestCase,
    Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class LoginTest
 * @package Tests\Feature
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->seed(\LaratrustSeeder::class);
        $this->user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);
        $this->user = $this->user->attachRole(Role::where('name', User::ROLE_USER)->first());
    }

    /**
     * @test
     */
    public function loginSuccess()
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => '123456',
        ]);

        $response->assertSuccessful();
        $response->assertHeader('authorization');
    }

    /**
     * @test
     */
    public function getUser()
    {
        $responseAuth = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => '123456',
        ]);

        $token = "Bearer " . $responseAuth->headers->get('authorization');
        $response = $this->getJson(route('getUser'), ['Authorization' => $token]);

        $response->assertSuccessful();
        $this->assertEquals($this->user->name, $response->json('data.name'));
        $this->assertEquals($this->user->id, $response->json('data.id'));
        $this->assertEquals($this->user->email, $response->json('data.email'));
        $this->assertEquals($this->user->getRole(), $response->json('data.role'));
    }

    /**
     * @test
     */
    public function loginFail()
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => '1234123',
        ]);

        $response->assertJsonValidationErrors(['email']);
    }
}
