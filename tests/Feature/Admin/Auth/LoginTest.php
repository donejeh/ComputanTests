<?php

namespace Tests\Feature\Admin\Auth;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_login_username_or_email_and_password()
    {
        $response = $this->post('/admin',[
            'login' =>'admin',
            'password' =>'password'
        ]);

        $response = $this->post('/admin',[
            'login' =>'admin@gmail.com',
            'password' =>'password'
        ]);

        $response->assertStatus(302,$response->getStatusCode()); // 302 because we are redirecting
       
    }

    public function test_admin_cannot_login_with_incorrect_details()
    {
        $response = $this->from('/admin')->post('/admin',[
            'login' =>'Error',
            'password' =>'password'
        ]);
 
        $response->assertRedirect('/admin');
        $response->assertSessionHasErrors('login');
        $this->assertTrue(session()->hasOldInput('login'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

}
