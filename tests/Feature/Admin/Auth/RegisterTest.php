<?php

namespace Tests\Feature\Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_register()
    {
      
        $response = $this->post('admin/register',[
            'name' =>'admin admin',
            'username' =>'example',
            'email' =>'example@gmail.com',
            'password' =>'password',
            'password_confirmation' =>'password',
        ]);

        $this->assertDatabaseHas('admins',['username' => 'example']);

        $response->assertStatus(302,$response->getStatusCode());  // 302 because we are redirecting
       
    }
}
