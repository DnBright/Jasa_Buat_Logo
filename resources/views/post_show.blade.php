<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog Logofolio</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-base: #09090b;
            --bg-surface: #18181b;
            --bg-card: rgba(39, 39, 42, 0.4);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --brand-color1: #f43f5e;
            --brand-color2: #8b5cf6;
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
            line-height: 1.8;
            overflow-x: hidden;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        header {
            margin-bottom: 40px;
            text-align: center;
        }

        .tag {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .meta {
            color: var(--text-secondary);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .meta i {
            color: var(--brand-color1);
        }

        .hero-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 24px;
            border: 1px solid var(--border-subtle);
            margin-bottom: 40px;
        }

        .content {
            font-size: 1.1rem;
            color: #d4d4d8;
            margin-bottom: 50px;
        }

        .content p {
            margin-bottom: 25px;
        }

        .content h2, .content h3 {
            font-family: 'Outfit', sans-serif;
            color: var(--text-primary);
            margin: 40px 0 20px 0;
            font-weight: 700;
        }

        .content h2 {
            font-size: 1.6rem;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 10px;
        }

        .footer-cta {
            border-top: 1px solid var(--border-subtle);
            padding-top: 40px;
            text-align: center;
        }

        .btn-outline {
            display: inline-block;
            text-align: center;
            padding: 14px 30px;
            border-radius: 10px;
            border: 1px solid var(--text-secondary);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
            transform: translateY(-2px);
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .logo-mark {
            width: 25px;
            height: 25px;
            background: var(--brand-gradient);
            border-radius: 6px;
            display: inline-block;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>

    <div class="container">
        
        <header>
            <a href="/" class="logo-text">
                <span class="logo-mark"></span> Logofolio.
            </a>
            <br>
            <span class="tag">Tips Branding</span>
            <h1>{{ $post->title }}</h1>
            <div class="meta">
                <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span><i class="fa-regular fa-user"></i> Oleh Admin</span>
            </div>
        </header>

        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="hero-image">
        @else
            <img src="https://images.unsplash.com/photo-1541462608141-2ff01dd914e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $post->title }}" class="hero-image">
        @endif

        <div class="content">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="footer-cta">
            <a href="/" class="btn-outline"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>

    </div>

</body>
</html>
