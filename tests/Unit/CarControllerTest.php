<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_create_car(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('admin.car.store'), [
            'make' => 'Skoda',
            'model' => 'Fabia',
            'year' => 2022,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('cars', ['make' => 'Skoda']);
    }

    public function tast_can_read_cars(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $car = Car::factory()->create(['user_id' => $user->id]);
        
        $response = $this->get(route('admin.car.idnex'));

        $response->assertStatus(200);
        $response->assertSee($car->make);
    }

    public function test_can_update_car()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $car = Car::factory()->create(['user_id' => $user->id]);

        $response = $this->put(route('admin.car.update', ['id' => $car->id]), [
            'make' => 'Updated Make',
            'model' => 'Updated Model',
            'year' => 2023,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('cars', ['id' => $car->id, 'make' => 'Updated Make']);
    }

    public function test_can_delete_car()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $car = Car::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('admin.car.destroy', ['id' => $car->id]));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}
