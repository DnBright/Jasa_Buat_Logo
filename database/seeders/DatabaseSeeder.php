<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\Post;
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
            'role' => 'admin',
        ]);

        // Seed initial Portfolios
        Portfolio::create([
            'title' => 'Aura Skincare',
            'category' => 'Minimalist / Wordmark',
            'image_path' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        Portfolio::create([
            'title' => 'Nexus Tech',
            'category' => 'Modern / Geometric',
            'image_path' => 'https://images.unsplash.com/photo-1636114673156-052a83459fc1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        Portfolio::create([
            'title' => 'Brew & Co.',
            'category' => 'Vintage / Emblem',
            'image_path' => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        Portfolio::create([
            'title' => 'Pinnacle Capital',
            'category' => 'Corporate / Monogram',
            'image_path' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        // Seed default Site Settings
        SiteSetting::getSettings();

        // Seed testimonials
        Testimonial::create([
            'client_name' => 'Aura Skincare',
            'company_name' => 'Skincare Brand',
            'rating' => 5,
            'content' => 'Desain logo dari Logofolio sangat mendalam dan filosofis. Sangat merepresentasikan identitas skincare kami.',
            'is_visible' => true,
        ]);

        Testimonial::create([
            'client_name' => 'Nexus Tech',
            'company_name' => 'Tech Startup',
            'rating' => 5,
            'content' => 'Sangat profesional! Pengerjaan cepat, revisi dilayani dengan sabar sampai kami mendapatkan logo geometric yang tepat.',
            'is_visible' => true,
        ]);

        Testimonial::create([
            'client_name' => 'Brew & Co.',
            'company_name' => 'F&B Brand',
            'rating' => 5,
            'content' => 'Visual branding yang sangat kuat. Coffee shop kami kini tampil beda dan menarik banyak pelanggan baru.',
            'is_visible' => true,
        ]);

        // Seed posts (blog)
        Post::create([
            'title' => '5 Prinsip Utama Desain Logo yang Efektif',
            'slug' => '5-prinsip-utama-desain-logo-yang-efektif',
            'content' => "Ketahui apa saja hal krusial yang membuat sebuah logo diingat seumur hidup oleh pelanggan Anda.\n\nSebuah logo bukan sekadar gambar indah, melainkan wajah dari bisnis Anda. Desain logo yang sukses harus memenuhi lima kriteria berikut:\n\n1. Sederhana (Simple)\nLogo yang sederhana akan mudah dikenali, diingat, dan digunakan di berbagai media tanpa kehilangan detailnya.\n\n2. Mudah Diingat (Memorable)\nLogo harus menyisakan kesan yang kuat di benak konsumen hanya dalam beberapa detik pertama mereka melihatnya.\n\n3. Abadi (Timeless)\nHindari tren sesaat. Desain logo harus tetap relevan dan kuat meskipun sudah berjalan 10, 20, atau 50 tahun ke depan.\n\n4. Serbaguna (Versatile)\nLogo harus terlihat bagus baik di layar ponsel pintar berukuran kecil, kop surat, hingga papan reklame jalan raya raksasa.\n\n5. Sesuai (Appropriate)\nWarna dan estetika logo harus mencerminkan industri usaha Anda secara tepat.",
            'image_path' => null,
            'status' => 'published',
        ]);

        Post::create([
            'title' => 'Psikologi Warna dalam Desain Logo',
            'slug' => 'psikologi-warna-dalam-desain-logo',
            'content' => "Mengapa warna merah memicu rasa lapar dan warna biru memicu kepercayaan? Simak ulasan psikologi warna dalam memperkuat brand identity bisnis Anda.\n\nKetika seseorang melihat logo, otak mereka merespons warna terlebih dahulu sebelum memproses bentuk atau teks. Memahami pesan emosional di balik warna sangatlah penting:\n\n- Merah: Energi, gairah, keberanian, dan urgensi. Sering digunakan oleh brand makanan cepat saji.\n- Biru: Kepercayaan, profesionalisme, keamanan, dan kedamaian. Sangat populer di industri finansial dan teknologi.\n- Hijau: Pertumbuhan, kesehatan, alam, dan kesegaran. Cocok untuk brand produk organik atau berkelanjutan.\n- Kuning: Keceriaan, optimisme, dan perhatian. Warna yang sangat kuat menarik mata.\n- Hitam: Kemewahan, keanggunan, kekuatan, dan eksklusivitas. Sering digunakan oleh brand fashion premium.",
            'image_path' => null,
            'status' => 'published',
        ]);
    }
}
