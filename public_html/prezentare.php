<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Prezentare aplicație</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #003366, #005580, #0077aa, #0099cc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            text-align: center;
            padding: 60px;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        /* Logo instituție mai mare */
        .logo {
            max-width: 260px;
            margin-bottom: 40px;
        }

        h1 {
            font-size: 34px;
            margin-bottom: 12px;
        }

        p {
            font-size: 20px;
            font-style: italic;
            margin-bottom: 45px;
            color: #e0e0e0;
        }

        .buton {
            padding: 14px 28px;
            background-color: #ffffff;
            color: #003366;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.3);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .buton:hover {
            background-color: #e0e0e0;
            color: #000000;
        }

        /* Logouri tehnologii mărite și spațiate */
        .logo-tehnologii {
            display: flex;
            justify-content: center;
            gap: 80px; /* distanță mai mare între logouri */
            margin-top: 70px;
            flex-wrap: wrap;
        }

        .logo-tehnologii img {
            max-width: 200px; /* logouri mai mari */
            height: auto;
            border-radius: 12px;
            box-shadow: 0 0 14px rgba(255,255,255,0.35);
        }

        .logo-item {
            text-align: center;
        }

        .logo-item p {
            margin-top: 12px;
            font-size: 17px;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Logo instituție mărit -->
    <img src="images/educatie.png" alt="Logo instituție" class="logo">

    <!-- Titlu și subtitlu -->
    <h1>Aplicație web pentru instituțiile preuniversitare din Republica Moldova</h1>
    <p>Platformă academică pentru managementul activității școlare</p>

    <!-- Buton accesare -->
    <a href="login.php" class="buton">🚀 Accesează platforma</a>

    <!-- Logouri tehnologii mărite și spațiate -->
    <div class="logo-tehnologii">
        <div class="logo-item">
            <img src="images/apache.png" alt="Apache">
            <p>Apache Server</p>
        </div>
        <div class="logo-item">
            <img src="images/html_css_js.png" alt="HTML CSS JS">
            <p>HTML + CSS + JS</p>
        </div>
        <div class="logo-item">
            <img src="images/php.png" alt="PHP">
            <p>PHP</p>
        </div>
    </div>

</body>
</html>
