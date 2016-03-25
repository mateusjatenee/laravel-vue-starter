<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

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
                'name' => $credentials['name'],
                'email' => $credentials['email'],
            ])->assertResponseStatus(200);
    }
    public function test_user_can_login()
    {
        $user = factory(User::class)->create();

        $req = $this->post('/api/auth/login', $user)
            ->seeJson([
                'name' => $user->name,
                'email' => $user->email,
            ])->assertResponseStatus(200);
    }
}
