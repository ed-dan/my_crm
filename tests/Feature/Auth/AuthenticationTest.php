<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Position;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '123123123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
 
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $this->setFactoryData(User::ADMIN_ID);

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);
        
        $this->assertGuest();
        $response->assertStatus(302);

    }

    public function test_unauthenticated_user_can_not_cannot_access_home_page(): void
    {
        $response = $this->get('/');
        
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_unauthenticated_user_can_not_cannot_access_deals(): void
    {
        $response = $this->get('/deals');
        
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
    
    public function test_unauthenticated_user_can_not_cannot_access_tasks(): void
    {
        $response = $this->get('/tasks');
        
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_unauthenticated_user_can_not_cannot_access_products(): void
    {
        $response = $this->get('/products');
        
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
    
    public function test_unauthenticated_user_can_not_cannot_access_companies(): void
    {
        $response = $this->get('/companies');
        
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
