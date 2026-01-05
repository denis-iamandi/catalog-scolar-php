<?php
// NU pune nimic înainte de aceste linii
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Autentificare - Aplicație Educațională</title>
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

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .login-box {
            background: rgba(255,255,255,0.15);
            padding: 30px;
            width: 350px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.25);
            backdrop-filter: blur(6px);
        }

        .login-box input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
        }

        .login-box button {
            width: 95%;
            padding: 12px;
            background: #ffffff;
            color: #003366;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .login-box button:hover {
            background: #e0e0e0;
            color: #000;
        }

        .footer {
            margin-top: 40px;
            font-size: 14px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <h1>APLICAȚIE WEB PENTRU INSTITUȚIILE PREUNIVERSITARE DE ÎNVĂȚĂMÂNT DIN REPUBLICA MOLDOVA</h1>

    <div class="login-box">
        <h2>Autentificare utilizator</h2>

        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Utilizator" required>
            <input type="password" name="password" placeholder="Parolă" required>
            <button type="submit">Autentificare</button>
        </form>
    </div>

    <div class="footer">
        <p>Tehnologii utilizate: Apache • PHP • MySQL • HTML • CSS • JS</p>
    </div>

</body>
</html>
