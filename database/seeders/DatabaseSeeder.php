<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            \App\Models\User::factory(10)->create();
            \App\Models\Category::factory(5)->create();
            \App\Models\Product::factory(5)->create();
            \App\Models\User::factory(5)->create();
            \App\Models\Customer::factory(5)->create();

            Order::factory(5)->create()->each(function($order){
               $order->details()->create([
                   'order_id' => $order->id,
                   'product_id' => Product::all()->random()->id,
                   'quantity' => $order->items,
                   'changes' =>0,
                   'price' => $order->total/$order->items,
               ]);
            });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
