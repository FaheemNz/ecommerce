<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Sony Watch 1',
            'slug' => 'sony-Watch-1', 'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product1.png',
            'images' => '["product/product1.png", "product/product1.png", "product/product1.png", "product/product1.png"]'
        ])->categories()->attach(1);
        Product::create([
            'name' => 'Sony Lotion 2',
            'slug' => 'sony-lotion-2',
            'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product2.png',
            'images' => '["product/product2.png", "product/product2.png", "product/product2.png", "product/product2.png"]'
        ])->categories()->attach(1);
        Product::create([
            'name' => 'Sony Handfree 1',
            'slug' => 'sony-handfree-1', 'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product3.png',
            'images' => '["product/product3.png", "product/product3.png", "product/product3.png", "product/product3.png"]'
        ])->categories()->attach(2);
        Product::create([
            'name' => 'Sony Blower 2',
            'slug' => 'sony-Blower-2', 'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product4.png',
            'images' => '["product/product4.png", "product/product4.png", "product/product4.png", "product/product4.png"]'
        ])->categories()->attach(2);
        Product::create([
            'name' => 'Sony Bag 2',
            'slug' => 'sony-bag-2', 'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product5.png',
            'images' => '["product/product5.png", "product/product5.png", "product/product5.png", "product/product5.png"]'
        ])->categories()->attach(3);
        Product::create([
            'name' => 'Sony Car 2',
            'slug' => 'sony-Car-2', 'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product6.png',
            'images' => '["product/product6.png", "product/product6.png", "product/product6.png", "product/product6.png"]'
        ])->categories()->attach(3);
        Product::create([
            'name' => 'Sony Dish 2',
            'slug' => 'sony-dish-2',
            'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product7.png',
            'images' => '["product/product7.png", "product/product7.png", "product/product7.png", "product/product7.png"]'
        ])->categories()->attach(4);
        Product::create([
            'name' => 'Samsung Handfree 2',
            'slug' => 'samsung-handfree-2',
            'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(500, 5000),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
            'image' => 'product/product8.png',
            'images' => '["product/product8.png", "product/product8.png", "product/product8.png", "product/product8.png"]'
        ])->categories()->attach(4);
    }
}
