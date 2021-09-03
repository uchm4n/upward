<?php

namespace Tests\Feature;

use App\Models\Product;
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
}
