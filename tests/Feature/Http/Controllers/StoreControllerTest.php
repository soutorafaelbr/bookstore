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

        $this->postJson(route('stores.store'), $store->toArray());

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

        $this->postJson(route('stores.store'), $store->toArray());

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

        $this->postJson(route('stores.store'), $store->toArray())
            ->assertJson([
                'name' => $store->name,
                'address' => $store->address,
                'active' => $store->active,
            ]);
    }

    public function test_updates_a_store()
    {
        Sanctum::actingAs($user = User::factory()->create());

        $store = Store::factory()->create();

        $this->putJson(route('stores.update', $store->id), $updatedStore = Store::factory()->make()->toArray());

        $this->assertDatabaseHas(
            'stores',
            [
                'name' => data_get($updatedStore, 'name'),
                'address' => data_get($updatedStore, 'address'),
                'active' => data_get($updatedStore, 'active'),
            ]
        );
    }

    public function test_responds_with_updated_data()
    {
        Sanctum::actingAs(User::factory()->create());

        $store = Store::factory()->create();

        $this->putJson(route('stores.update', $store->id), $updatedStore = Store::factory()->make()->toArray())
            ->assertJson([
                'name' => data_get($updatedStore, 'name'),
                'address' => data_get($updatedStore, 'address'),
                'active' => data_get($updatedStore, 'active'),
            ]);
    }

    public function test_responds_with_status_200_after_update()
    {
        Sanctum::actingAs(User::factory()->create());

        $store = Store::factory()->create();

        $this->putJson(route('stores.update', $store->id), Store::factory()->make()->toArray())
            ->assertOk();
    }

    public function test_lists_stores()
    {
        Sanctum::actingAs(User::factory()->create());
        Store::factory()->count(10)->create();

        $this->getJson(route('stores.index'))->assertOk();
    }
}
