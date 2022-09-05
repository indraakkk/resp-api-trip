<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\MyTestCase;

class AuthTest extends MyTestCase
{

    protected $user_data;


    public function setUp():void
    {
        parent::setUp();
        $this->user_data = $this->generateUser();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_auth()
    {
        $this->test_register($this->user_data);
        $this->test_logout($this->user_data);
        $this->test_login($this->user_data);
    }

    protected function test_register()
    {
        \Log::debug('log out : ' . __LINE__, [$this->user_data]);
        $response = $this->post('/api/register', $this->user_data);
        $header = [
            'Authorization' => 'Bearer '.$response['token'],
            'Accept' => 'application/json'
        ];
        $this->user_data['id'] = $response['user']['id'];
        $this->user_data['header'] = $header;
        $response->assertStatus(200);
    }

    protected function test_logout()
    {
        $data = $this->user_data;
        \Log::debug('log out : ' . __LINE__, [$this->user_data]);
        $response = $this->post('/api/logout', [], $data['header']);
        $response->assertStatus(200);
    }

    protected function test_login()
    {
        $data = $this->user_data;
        \Log::debug('log out : ' . __LINE__, [$this->user_data]);
        $body = [
            'email' => $data['email'],
            'password' => 'password'
        ];
        \Log::debug('log out : ' . __LINE__, [$body]);

        $response = $this->post('/api/login', $body);
        $response->assertStatus(200);
    }

    protected function generateUser()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => "password",
        ];
    }
}
