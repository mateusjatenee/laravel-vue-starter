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
            ]);
    }
}
