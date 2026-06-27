<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Registry | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #b89264;
            --primary-hover: #a37f53;
            --dark: #1e293b;
            --light: #f8fafc;
            --font-head: 'Poppins', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        header {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            padding: 0 20px;
            max-width: 1200px;
            z-index: 1000;

            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);

            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0px;
        }

        .logo {
            font-family: var(--font-head);
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .logo span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }

        .hero-section {
            position: relative;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=2069&auto=format&fit=crop') center center/cover no-repeat;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.5));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-family: var(--font-head);
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .hero-content p {
            font-size: clamp(16px, 2vw, 20px);
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 35px;
            font-weight: 400;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-btn {
            display: inline-block;
            font-family: var(--font-body);
            background-color: var(--primary);
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 14px 36px;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(184, 146, 100, 0.4);
        }

        .cta-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(184, 146, 100, 0.6);
        }

        .cta-btn:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <!-- Transparent Navigation Layout -->
    <header>
        <nav class="navbar">
            <a href="index.php" class="logo">Pawsome<span>Registry</span></a>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="dog_register.php">Register Dog</a></li>
                <li><a href="dog_view.php">View Records</a></li>
            </ul>
        </nav>
    </header>

    <!-- Content Screen Canvas -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Register your dogs</h1>
            <p>A centralized data management system built specifically for tracking canine profiles cleanly and securely.</p>
            <a href="dog_register.php" class="cta-btn">Register Now</a>
        </div>
    </section>

</body>
</html>
