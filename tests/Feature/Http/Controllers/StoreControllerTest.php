<?php

namespace Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    public function test_stores_a_store()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $store = Store::factory()->make();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->postJson(route('stores.store'), $store->toArray());

        $this->assertDatabaseHas(
            'stores',
            [
                'name' => $store->name,
                'address' => $store->address,
                'active' => $store->active,
            ]
        );
    }

    public function test_responds_with_created_status()
    {
        $store = Store::factory()->create();

        Sanctum::actingAs($user = User::factory()->create());

        $store = Store::factory()->make();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->postJson(route('stores.store'), $store->toArray());

        $this->assertDatabaseHas(
            'stores',
            [
                'name' => $store->name,
                'address' => $store->address,
                'active' => $store->active,
            ]
        );
    }

    public function test_responds_with_store()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $store = Store::factory()->make();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->postJson(route('stores.store'), $store->toArray())
            ->assertJson([
                'name' => $store->name,
                'address' => $store->address,
                'active' => $store->active,
            ]);
    }
}
