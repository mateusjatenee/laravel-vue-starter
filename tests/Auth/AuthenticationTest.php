<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $credentials['name'] = 'John';
        $credentials['email'] = 'john@gmail.com';
        $credentials['password'] = str_random(5);

        $this->post('/api/auth/register', $credentials)
            ->seeJson([
                'name'  => $credentials['name'],
                'email' => $credentials['email'],
            ])->assertResponseStatus(200);
    }

    public function test_user_can_login()
    {
        $password = str_random(10);
        $user = factory(User::class)->create([
            'password' => bcrypt($password),
        ]);

        $token = JWTAuth::fromUser($user);

        $req = $this->post('/api/auth/login', [
            'email'    => $user->email,
            'password' => $password,
        ])->seeJson([
            'token' => $token,
        ]);
    }
}
