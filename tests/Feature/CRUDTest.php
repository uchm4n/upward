<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CRUDTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all()
    {
        $response = $this->json('GET', '/api/products');
        $response->assertStatus(200);
        $response->assertJson([
            'current_page' => 1,
            'per_page'     => 15,
            'from'         => 1,
            'to'           => 15,
            'last_page'    => 4
        ])
            ->assertJsonStructure(['data' => ['*' => array_keys((new Product())->toArray())]]);
    }

    public function check_gest()
    {
        $response = $this->json('POST', '/api/products', []);
        $response->assertJson(['message' => 'Unauthenticated.']);
    }

    /**
     * @group apilogintests
     */
    public function testApiLogin()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $create = $this->json('POST', '/api/products', [
            'id'      => 1111,
            'name'    => 'test',
            'year'    => '1111',
            'photo'   => 'test',
            'user_id' => $user->id
        ]);

        $create->assertJson(['message' => 'Products was created']);

        // Delete created
        $latest = Product::all()->pluck('id')->toArray();
        $delete = $this->json('DELETE', '/api/products/'.end($latest));
        $delete->assertJson(['message' => 'Products was deleted']);
    }

}
