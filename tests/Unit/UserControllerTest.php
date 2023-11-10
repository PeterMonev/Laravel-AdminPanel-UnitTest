<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_create_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('admin.user.store'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '1234567890',
            'password' => '12345678',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['name' => 'John Doe']);
    }

    public function test_can_read_users()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->put(route('admin.user.update', ['id' => $user->id]), [
            'name' => 'Updated Name',
            'email' => 'updated.email@example.com',
            'phone_number' => '9876543210',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }


    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.user.destroy', ['id' => $user->id]));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
