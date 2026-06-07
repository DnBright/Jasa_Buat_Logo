<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logofolio - Professional Logo & Brand Identity Design</title>
    
    <!-- Fonts: Outfit for modern, geometric look (very popular for design agencies) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Three.js for 3D Interactions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        :root {
            --bg-base: #09090b; /* Very dark zinc */
            --bg-surface: #18181b; /* Dark zinc */
            --bg-card: rgba(39, 39, 42, 0.4);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --brand-color1: #f43f5e; /* Rose */
            --brand-color2: #8b5cf6; /* Violet */
            --brand-gradient: linear-gradient(135deg, var(--brand-color1), var(--brand-color2));
            --border-subtle: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3, h4, .logo-text {
            font-family: 'Outfit', sans-serif;
        }

        /* Utility Classes */
        .text-gradient {
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(9, 9, 11, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            z-index: 1000;
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -1px;
        }

        .logo-mark {
            width: 30px;
            height: 30px;
            background: var(--brand-gradient);
            border-radius: 8px;
            display: inline-block;
            transform: rotate(45deg);
        }

        .nav-links {
            display: flex;
            gap: 35px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--text-primary);
        }

        .btn-gradient {
            background: var(--brand-gradient);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.3);
            display: inline-block;
        }

        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5);
        }

        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            overflow: hidden;
        }

        #creative-canvas {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 1;
            pointer-events: auto;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 650px;
            padding-left: 5vw;
            pointer-events: none;
        }

        .hero-content > * { pointer-events: auto; }

        .tagline {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-subtle);
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(3.5rem, 6vw, 5rem);
            font-weight: 800;
            line-height: 1.05;
            margin-bottom: 25px;
            letter-spacing: -2px;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            max-width: 500px;
            line-height: 1.7;
        }

        section {
            padding: 120px 0;
            position: relative;
            z-index: 10;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 80px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 2px;
            background: var(--brand-gradient);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before { transform: scaleX(1); }
        .feature-card:hover { transform: translateY(-10px); background: rgba(39, 39, 42, 0.8); }

        .feature-icon {
            font-size: 35px;
            margin-bottom: 25px;
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .portfolio-section {
            background-color: var(--bg-surface);
            border-top: 1px solid var(--border-subtle);
            border-bottom: 1px solid var(--border-subtle);
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .portfolio-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: #27272a;
            cursor: pointer;
            border: 1px solid var(--border-subtle);
        }

        .portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .portfolio-item:hover img {
            transform: scale(1.08);
        }

        .portfolio-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(9, 9, 11, 0.9) 0%, transparent 50%);
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .portfolio-overlay h3 { font-size: 1.4rem; margin-bottom: 5px; }
        .portfolio-overlay p { color: var(--brand-color2); font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            perspective: 1000px;
        }

        .pricing-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 24px;
            padding: 50px 40px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.1s ease;
        }

        .pricing-card.popular {
            background: linear-gradient(to bottom, rgba(39, 39, 42, 0.8), rgba(139, 92, 246, 0.1));
            border-color: var(--brand-color2);
        }

        .popular-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%) translateZ(30px);
            background: var(--brand-gradient);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .pricing-card > * { transform: translateZ(30px); } /* 3D Pop out effect */

        .pricing-card h3 { font-size: 1.8rem; margin-bottom: 10px; }
        .pricing-card p.desc { color: var(--text-secondary); margin-bottom: 30px; font-size: 0.95rem; }
        .price { font-size: 3rem; font-weight: 800; font-family: 'Outfit', sans-serif; margin-bottom: 30px; display: flex; align-items: flex-end; gap: 5px; }
        .price span { font-size: 1rem; color: var(--text-secondary); font-weight: 500; margin-bottom: 10px; }
        
        .pricing-features { list-style: none; margin-bottom: 40px; }
        .pricing-features li { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px; color: #d4d4d8; font-size: 0.95rem; }
        .pricing-features li i { color: var(--brand-color1); margin-top: 5px; font-size: 14px; }
        .pricing-features li.disabled { opacity: 0.4; }
        .pricing-features li.disabled i { color: var(--text-secondary); }

        .btn-outline {
            display: block;
            text-align: center;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid var(--text-secondary);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: white; }
        
        .pricing-card.popular .btn-outline {
            background: var(--brand-gradient);
            border: none;
        }

        footer {
            border-top: 1px solid var(--border-subtle);
            padding: 60px 20px 40px;
            text-align: center;
        }

        .footer-logo { margin-bottom: 20px; justify-content: center; }
        .social-links { display: flex; justify-content: center; gap: 20px; margin-bottom: 30px; }
        .social-links a {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s;
        }
        .social-links a:hover { background: var(--brand-gradient); transform: translateY(-3px); }

        @media (max-width: 992px) {
            #creative-canvas { width: 100%; opacity: 0.3; pointer-events: none; }
            .hero-content { padding-left: 0; margin: 0 auto; text-align: center; }
            .hero p { margin-left: auto; margin-right: auto; }
        }

        @media (max-width: 768px) {
            nav { padding: 15px 20px; }
            .nav-links { display: none; }
            .hero h1 { font-size: 2.8rem; }
        }
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo-text">
            <span class="logo-mark"></span> {{ $settings->site_name }}.
        </a>
        <ul class="nav-links">
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#portofolio">Karya</a></li>
            <li><a href="#harga">Paket Harga</a></li>
        </ul>
        <a href="https://wa.me/{{ $settings->contact_whatsapp }}" target="_blank" class="btn-gradient">Konsultasi Gratis</a>
    </nav>

    <header class="hero">
        <div id="creative-canvas"></div>
        
        <div class="container" style="position: relative; z-index: 2; width: 100%;">
            <div class="hero-content">
                <div class="tagline">{{ $settings->hero_tagline }}</div>
                <h1>{!! $settings->hero_title !!}</h1>
                <p>{{ $settings->hero_description }}</p>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <a href="#portofolio" class="btn-gradient" style="padding: 16px 35px; font-size: 1.1rem;">Lihat Portofolio</a>
                    <a href="#harga" class="btn-outline" style="width: auto; padding: 16px 35px; font-size: 1.1rem; background: transparent;">Pilih Paket</a>
                </div>
            </div>
        </div>
    </header>

    <section id="layanan">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih <span class="text-gradient">Kami?</span></h2>
            <p class="section-subtitle">Proses kreatif yang didesain untuk kepuasan dan kesuksesan brand Anda.</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-pen-nib"></i></div>
                    <h3>100% Desain Orisinal</h3>
                    <p>Mulai dari sketsa tangan kosong. Kami tidak menggunakan template, stock icon, atau AI generator. Logo Anda dijamin unik dan dapat didaftarkan HAKI.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-infinity"></i></div>
                    <h3>Revisi Fleksibel</h3>
                    <p>Kepuasan Anda adalah prioritas. Kami menawarkan proses revisi yang kolaboratif hingga logo benar-benar merepresentasikan visi bisnis Anda.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-box-open"></i></div>
                    <h3>Master File Lengkap</h3>
                    <p>Dapatkan semua format file yang Anda butuhkan: Vector (AI, EPS), PDF, SVG, transparan PNG, dan variasi warna (RGB & CMYK untuk cetak).</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-book-open"></i></div>
                    <h3>Brand Guidelines</h3>
                    <p>Tidak hanya logo, kami menyertakan panduan identitas visual (aturan warna, tipografi, grid) agar brand Anda tampil konsisten di semua media.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="portofolio" class="portfolio-section">
        <div class="container">
            <h2 class="section-title">Karya <span class="text-gradient">Terbaik</span></h2>
            <p class="section-subtitle">Eksplorasi visual dari berbagai industri yang telah kami tangani.</p>

            <div class="portfolio-grid">
                @if($portfolios->isNotEmpty())
                    @foreach($portfolios as $portfolio)
                    <div class="portfolio-item">
                        <img src="{{ \Illuminate\Support\Str::startsWith($portfolio->image_path, ['http://', 'https://']) ? $portfolio->image_path : asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                        <div class="portfolio-overlay">
                            <h3>{{ $portfolio->title }}</h3>
                            <p>{{ $portfolio->category }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="portfolio-item">
                        <!-- Image placeholder representing logo mockups -->
                        <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Minimalist Logo Design Mockup">
                        <div class="portfolio-overlay">
                            <h3>Aura Skincare</h3>
                            <p>Minimalist / Wordmark</p>
                        </div>
                    </div>
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1636114673156-052a83459fc1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tech Startup Logo">
                        <div class="portfolio-overlay">
                            <h3>Nexus Tech</h3>
                            <p>Modern / Geometric</p>
                        </div>
                    </div>
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1600861194942-f883de0dfe96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Coffee Shop Branding">
                        <div class="portfolio-overlay">
                            <h3>Brew & Co.</h3>
                            <p>Vintage / Emblem</p>
                        </div>
                    </div>
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Corporate Branding">
                        <div class="portfolio-overlay">
                            <h3>Pinnacle Capital</h3>
                            <p>Corporate / Monogram</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="harga">
        <div class="container">
            <h2 class="section-title">Investasi <span class="text-gradient">Identitas</span></h2>
            <p class="section-subtitle">Pilih paket desain yang sesuai dengan skala dan kebutuhan bisnis Anda.</p>
 
            <div class="pricing-grid">
                <!-- Basic Plan -->
                <div class="pricing-card tilt-card">
                    <h3>Startup</h3>
                    <p class="desc">Cocok untuk UMKM atau bisnis baru yang membutuhkan logo profesional dengan cepat.</p>
                    <div class="price">{!! $settings->price_startup !!}</div>
                    <ul class="pricing-features">
                        <li><i class="fa-solid fa-check"></i> 2 Konsep Logo Pilihan</li>
                        <li><i class="fa-solid fa-check"></i> 3x Revisi Desain</li>
                        <li><i class="fa-solid fa-check"></i> Resolusi Tinggi (PNG/JPG)</li>
                        <li><i class="fa-solid fa-check"></i> File Vector Master (AI/EPS)</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Brand Guidelines Book</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Desain Kartu Nama</li>
                    </ul>
                    <a href="https://wa.me/{{ $settings->contact_whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20Paket%20Startup" target="_blank" class="btn-outline">Pilih Startup</a>
                </div>
                
                <!-- Pro Plan -->
                <div class="pricing-card popular tilt-card">
                    <div class="popular-badge">Direkomendasikan</div>
                    <h3>Professional</h3>
                    <p class="desc">Bagi bisnis menengah yang ingin membangun fondasi branding yang kuat dan konsisten.</p>
                    <div class="price">{!! $settings->price_professional !!}</div>
                    <ul class="pricing-features">
                        <li><i class="fa-solid fa-check"></i> 4 Konsep Logo Premium</li>
                        <li><i class="fa-solid fa-check"></i> Revisi Tanpa Batas (Unlimited)</li>
                        <li><i class="fa-solid fa-check"></i> Semua Format File Master</li>
                        <li><i class="fa-solid fa-check"></i> Brand Guidelines Ringkas</li>
                        <li><i class="fa-solid fa-check"></i> Desain Kartu Nama & Kop Surat</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> 3D Logo Mockup Animation</li>
                    </ul>
                    <a href="https://wa.me/{{ $settings->contact_whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20Paket%20Professional" target="_blank" class="btn-outline">Mulai Proyek Premium</a>
                </div>
 
                <!-- Enterprise Plan -->
                <div class="pricing-card tilt-card">
                    <h3>Full Identity</h3>
                    <p class="desc">Rebranding total atau perusahaan berskala besar dengan kebutuhan desain menyeluruh.</p>
                    <div class="price">{!! $settings->price_enterprise !!}</div>
                    <ul class="pricing-features">
                        <li><i class="fa-solid fa-check"></i> 6 Konsep Logo Eksklusif</li>
                        <li><i class="fa-solid fa-check"></i> Revisi Tanpa Batas & Prioritas</li>
                        <li><i class="fa-solid fa-check"></i> Comprehensive Brand Book</li>
                        <li><i class="fa-solid fa-check"></i> Full Stationery Kit Design</li>
                        <li><i class="fa-solid fa-check"></i> Social Media Kit (Templates)</li>
                        <li><i class="fa-solid fa-check"></i> Copyright Transfer Document</li>
                    </ul>
                    <a href="https://wa.me/{{ $settings->contact_whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20Paket%20Enterprise" target="_blank" class="btn-outline">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>
 
    <footer>
        <div class="container">
            <a href="#" class="logo-text footer-logo">
                <span class="logo-mark"></span> {{ $settings->site_name }}.
            </a>
            <div class="social-links">
                <a href="{{ $settings->instagram_url }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $settings->dribbble_url }}" target="_blank"><i class="fa-brands fa-dribbble"></i></a>
                <a href="{{ $settings->behance_url }}" target="_blank"><i class="fa-brands fa-behance"></i></a>
                <a href="{{ $settings->linkedin_url }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                &copy; 2026 {{ $settings->site_name }} Design Agency. Dibuat dengan presisi.<br>
                Hak Cipta Dilindungi Undang-Undang.
            </p>
        </div>
    </footer>

    <script>
        /* ==========================================
           1. THREE.JS 3D ABSTRACT LOGO ANIMATION
           ========================================== */
        window.onload = function() {
            const container = document.getElementById('creative-canvas');
            
            // Allow scene to be wider to push object to the right visually on desktop
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 100);
            camera.position.z = 12;

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);

            // Create a complex geometric shape representing "creativity/logo creation"
            // TorusKnot is perfect for an abstract, continuous, modern logo feel
            const geometry = new THREE.TorusKnotGeometry(2.5, 0.8, 200, 32);
            
            // Material 1: Wireframe to show the "process/blueprint"
            const wireframeMaterial = new THREE.MeshBasicMaterial({ 
                color: 0xf43f5e, // Rose pink
                wireframe: true,
                transparent: true,
                opacity: 0.2
            });

            // Material 2: Solid reflective material
            const solidMaterial = new THREE.MeshPhysicalMaterial({
                color: 0x8b5cf6, // Violet
                metalness: 0.7,
                roughness: 0.2,
                clearcoat: 1.0,
                clearcoatRoughness: 0.1,
                transparent: true,
                opacity: 0.9
            });

            // Combine into a group
            const knotMesh = new THREE.Mesh(geometry, solidMaterial);
            const knotWire = new THREE.Mesh(geometry, wireframeMaterial);
            // Scale wireframe slightly up to prevent z-fighting
            knotWire.scale.set(1.02, 1.02, 1.02);

            const logoGroup = new THREE.Group();
            logoGroup.add(knotMesh);
            logoGroup.add(knotWire);
            scene.add(logoGroup);

            // Lighting to make the Physical Material pop
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);

            const dirLight = new THREE.DirectionalLight(0xffffff, 2);
            dirLight.position.set(5, 5, 5);
            scene.add(dirLight);

            const pointLight = new THREE.PointLight(0xf43f5e, 5, 20);
            pointLight.position.set(-5, -5, 5);
            scene.add(pointLight);

            // Mouse Interaction Variables
            let mouseX = 0;
            let mouseY = 0;
            let targetX = 0;
            let targetY = 0;

            document.addEventListener('mousemove', (event) => {
                // Normalize mouse coordinates to -1 to +1
                mouseX = (event.clientX / window.innerWidth) * 2 - 1;
                mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
            });

            // Animation Loop
            function animate() {
                requestAnimationFrame(animate);

                // Base automatic rotation
                logoGroup.rotation.y += 0.005;
                logoGroup.rotation.x += 0.002;

                // Mouse Interaction Parallax
                targetX = mouseX * 0.5;
                targetY = mouseY * 0.5;
                
                logoGroup.position.x += (targetX - logoGroup.position.x) * 0.05;
                logoGroup.position.y += (targetY - logoGroup.position.y) * 0.05;

                // Floating effect
                logoGroup.position.y += Math.sin(Date.now() * 0.001) * 0.005;

                renderer.render(scene, camera);
            }

            animate();

            // Handle Window Resize for the specific container
            window.addEventListener('resize', () => {
                camera.aspect = container.clientWidth / container.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, container.clientHeight);
            });
        };

        /* ==========================================
           2. JS 3D TILT EFFECT FOR PRICING CARDS
           ========================================== */
        const tiltCards = document.querySelectorAll('.tilt-card');

        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left; 
                const y = e.clientY - rect.top;  
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Calculate tilt rotation (divider defines strength)
                const rotateX = ((y - centerY) / 20) * -1; 
                const rotateY = (x - centerX) / 20;

                // Apply transform
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                
                // Add subtle shadow reaction
                card.style.boxShadow = `${-rotateY}px ${rotateX}px 30px rgba(0,0,0,0.5)`;
            });

            // Reset when mouse leaves
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
                card.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>