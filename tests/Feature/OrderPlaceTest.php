<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class OrderPlaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_placed()
    {
        $customer = Customer::factory()->create();

        $product = Product::factory()->create();

        $order = Order::create([
            'customer_id' => $customer->id,
            'total' => $product->price,
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'customer_id' => $customer->id,
        ]);
    }
}
