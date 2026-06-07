<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default Admin User
        User::factory()->create([
            'name' => 'Admin Logofolio',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // Seed initial Portfolios
        \App\Models\Portfolio::create([
            'title' => 'Aura Skincare',
            'category' => 'Minimalist / Wordmark',
            'image_path' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Nexus Tech',
            'category' => 'Modern / Geometric',
            'image_path' => 'https://images.unsplash.com/photo-1636114673156-052a83459fc1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Brew & Co.',
            'category' => 'Vintage / Emblem',
            'image_path' => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Pinnacle Capital',
            'category' => 'Corporate / Monogram',
            'image_path' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        // Seed default Site Settings
        \App\Models\SiteSetting::getSettings();
    }
}
