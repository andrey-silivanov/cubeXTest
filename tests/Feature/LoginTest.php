<?php
declare (strict_types = 1);

namespace Tests\Feature;

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
        $this->user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);
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
        $this->assertEquals($this->user->name, $response->json('result.name'));
        $this->assertEquals($this->user->id, $response->json('result.id'));
        $this->assertEquals($this->user->email, $response->json('result.email'));
        $response->assertHeader('access_token');
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
