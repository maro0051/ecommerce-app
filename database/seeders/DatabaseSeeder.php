<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular customer
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Create sample products with images (using placeholder images)
        $products = [
            [
                'name' => 'Premium Laptop',
                'description' => 'High-performance laptop with latest Intel Core i7 processor, 16GB RAM, 512GB SSD, and stunning 4K display. Perfect for gaming and professional work.',
                'price' => 999.99,
                'stock' => 10,
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life, comfortable design, and crystal clear sound quality.',
                'price' => 199.99,
                'stock' => 25,
            ],
            [
                'name' => 'Smartphone Pro',
                'description' => 'Latest flagship smartphone with triple camera system, 6.7-inch OLED display, 5G support, and all-day battery life.',
                'price' => 699.99,
                'stock' => 15,
            ],
            [
                'name' => 'Fitness Tracker Watch',
                'description' => 'Track your fitness goals with this smart watch featuring heart rate monitor, GPS, sleep tracking, and 7-day battery life.',
                'price' => 49.99,
                'stock' => 50,
            ],
            [
                'name' => 'Mechanical Gaming Keyboard',
                'description' => 'RGB mechanical keyboard with customizable switches, programmable macros, and durable construction for gaming enthusiasts.',
                'price' => 129.99,
                'stock' => 30,
            ],
            [
                'name' => 'Wireless Gaming Mouse',
                'description' => 'High-precision wireless gaming mouse with 16000 DPI sensor, 7 programmable buttons, and RGB lighting.',
                'price' => 59.99,
                'stock' => 40,
            ],
            [
                'name' => 'USB-C Hub Adapter',
                'description' => '7-in-1 USB-C hub with 4K HDMI, USB 3.0 ports, SD card reader, and 100W power delivery.',
                'price' => 39.99,
                'stock' => 100,
            ],
            [
                'name' => 'External SSD 1TB',
                'description' => 'Portable external SSD with 1TB storage, USB 3.2 interface, and read speeds up to 1050MB/s.',
                'price' => 149.99,
                'stock' => 20,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}