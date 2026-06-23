<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claire Chaki - Responsive Profile & Showcase</title>
    <style>
        /* --- 1. BASE STYLES & MOBILE-FIRST LAYOUT --- */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #1e293b;
            font-size: 16px;
        }
        
        header {
            background-color: #2b5a9e;
            color: white;
            text-align: center;
            padding: 30px 15px;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* --- 2. FLEXBOX IMPLEMENTATION: Profile Box --- */
        .profile-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column; /* Mobile-first column stack */
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Responsive Image Handling Configuration */
        .profile-img {
            max-width: 150px;
            width: 100%;
            height: auto;
            border-radius: 50%;
            background: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #64748b;
            aspect-ratio: 1/1;
        }

        .profile-info {
            text-align: center;
        }

        h2 {
            color: #2b5a9e;
            margin-top: 0;
        }

        /* --- 3. CSS GRID IMPLEMENTATION: Product Showcase --- */
        .section-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .product-grid {
            display: grid;
            /* Auto-fit and minmax handles fluid scaling seamlessly */
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .product-img-placeholder {
            width: 100%;
            height: 180px;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #64748b;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #10b981;
            margin: 10px 0 0 0;
        }

        /* --- 4. RESPONSIVE BREAKPOINTS (Media Queries) --- */
        
        /* Tablet Media Breakpoint (768px and above) */
        @media (min-width: 768px) {
            body { font-size: 18px; }
            .profile-card {
                flex-direction: row; /* Converts layout axis to row orientation */
                text-align: left;
            }
            .profile-info { text-align: left; }
        }

        /* Laptop & Desktop Media Breakpoint (1024px and above) */
        @media (min-width: 1024px) {
            body { font-size: 19px; }
            header { padding: 50px 20px; }
        }
    </style>
</head>
<body>

    <header>
        <h1>BIT3208 Advanced Web Design Portfolio</h1>
        <p>Responsive Web Design & Mobile-First Integration</p>
    </header>

    <div class="container">
        
        <div class="profile-card">
            <div class="profile-img">👤 Profile Pic</div>
            <div class="profile-info">
                <h2>Claire Chaki Kihwaga</h2>
                <p><strong>Course:</strong> BSc. Information Technology (Mount Kenya University - Thika Campus)</p>
                <p><strong>About Me:</strong> Aspiring full-stack developer specializing in creating responsive, relational management architectures and secure web application frameworks.</p>
                <p><strong>Contact:</strong> claire@example.com</p>
            </div>
        </div>

        <h3 class="section-title">📦 Featured E-Commerce Showcase Catalog</h3>
        
        <div class="product-grid">
            <div class="product-card">
                <div class="product-img-placeholder">🔌 Charging Cable</div>
                <h3>Premium Type-C Charging Cable</h3>
                <p>Heavy-duty, braided nylon exterior fast-charging data cable built for long-lasting durability.</p>
                <p class="product-price">KES 450.00</p>
            </div>

            <div class="product-card">
                <div class="product-img-placeholder">🔋 Power Bank</div>
                <h3>20W Fast-Charge Powercube</h3>
                <p>Compact 10,000mAh external cell unit with smart safety delivery mechanics.</p>
                <p class="product-price">KES 2,800.00</p>
            </div>

            <div class="product-card">
                <div class="product-img-placeholder">🎧 Wireless Buds</div>
                <h3>Acoustic Wireless Earbuds</h3>
                <p>Immersive sound rendering with ambient active noise reduction profiles.</p>
                <p class="product-price">KES 3,500.00</p>
            </div>

            <div class="product-card">
                <div class="product-img-placeholder">💻 Laptop Stand</div>
                <h3>Ergonomic Aluminum Laptop Stand</h3>
                <p>Fully adjustable sleek metallic frame supporting proper workspace body posture alignment.</p>
                <p class="product-price">KES 1,950.00</p>
            </div>
        </div>

    </div>

</body>
</html>