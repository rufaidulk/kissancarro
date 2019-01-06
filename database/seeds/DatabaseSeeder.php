<?php

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
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 10)->create();
        factory(App\Model\Brand::class, 10)->create();
        factory(App\Model\Category::class, 15)->create();
        factory(App\Model\Product::class, 50)->create();
        factory(App\Model\Review::class, 300)->create();
        factory(App\Model\Profile::class, 30)->create();
        factory(App\Model\Order::class, 30)->create();
        factory(App\Model\Payment::class, 30)->create();
        factory(App\Model\Guest::class, 10)->create();
        factory(App\Model\Cart::class, 20)->create();
        
        // Get all the carts attaching up to 3 random carts to each product
        //$products = App\Model\Product::all();

        // Populate the pivot table
        /*App\Model\Cart::all()->each(function ($cart) use ($products) { 
            $cart->products()->attach(
                $products->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
        /*
        // Get all the carts attaching up to 3 random carts to each product
        $carts = App\Model\Cart::all();

        // Populate the pivot table
        App\Model\Product::all()->each(function ($product) use ($carts) { 
            $product->carts()->attach(
                $carts->random(rand(1, 3))->pluck('visitor')->toArray()
            ); 
        });
        */
    }
}
