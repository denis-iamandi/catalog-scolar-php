<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Panou de control</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #003366, #005580, #0077aa, #0099cc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            text-align: center;
            padding: 40px;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        /* Logo instituție mărit */
        .logo-institutie {
            max-width: 260px;
            margin-bottom: 35px;
        }

        h2 {
            font-size: 34px;
            margin-bottom: 10px;
        }

        .subtitlu {
            font-size: 20px;
            font-style: italic;
            letter-spacing: 1px;
            margin-bottom: 35px;
            color: #e0e0e0;
        }

        /* Butoane module – mici, albe, elegante */
        .buton {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #003366;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .buton:hover {
            background-color: #e0e0e0;
            color: #000000;
        }

        /* Logouri tehnologii mari și spațiate – ca în prezentare.php */
        .logo-tehnologii {
            display: flex;
            justify-content: center;
            gap: 80px;
            margin-top: 70px;
            flex-wrap: wrap;
        }

        .logo-tehnologii img {
            max-width: 200px;
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

    <!-- Logo instituție sus -->
    <img src="images/educatie.png" alt="Logo instituție" class="logo-institutie">

    <h2>🎓 Bun venit, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <div class="subtitlu">
        APLICAȚIE WEB PENTRU INSTITUȚIILE PREUNIVERSITARE DE ÎNVĂȚĂMÂNT DIN REPUBLICA MOLDOVA
    </div>

    <!-- Butoane module -->
    <a href="formular.php" class="buton">📝 Formular elev</a>
    <a href="orar_profesori.php" class="buton">📚 Orar și profesori</a>
    <a href="export_orar_excel.php" class="buton">📄 Export Orar Excel</a>
    <a href="prezentare.php" class="buton">🎬 Prezentare aplicație</a>
    <a href="absente.php" class="buton">📌 Evidență absențe</a>
    <a href="rapoarte.php" class="buton">📊 Rapoarte</a>
    <a href="export_raport_excel.php" class="buton">📄 Export Rapoarte Absențe Excel</a>
    <a href="note.php" class="buton">📌 Note elevi </a>
    <a href="logout.php" class="buton">🚪 Ieșire</a>

    <!-- Logouri tehnologii jos -->
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
