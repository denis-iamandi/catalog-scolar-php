<?php
// NU pune nimic înainte de aceste linii (nici spații, nici BOM)
session_start();

$conn = new mysqli("localhost", "root", "", "educatie");
if ($conn->connect_error) { 
    die("Conexiune eșuată: " . $conn->connect_error); 
}

// Dacă e deja autentificat, mergi direct la dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$mesaj = "";
if (isset($_POST['login'])) {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id FROM utilizatori WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $mesaj = "❌ Date incorecte!";
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Autentificare utilizator</title>
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background-color: #003366; 
            color: #fff; 
            text-align: center; 
            padding: 60px; 
        }
        .login-box { 
            background-color: #005580; 
            padding: 30px; 
            border-radius: 10px; 
            display: inline-block; 
            width: 320px;
        }
        input { 
            padding: 10px; 
            margin: 10px; 
            width: 85%; 
            border: none; 
            border-radius: 5px; 
        }
        button { 
            padding: 10px 20px; 
            background-color: #0077aa; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
        }
        button:hover { 
            background-color: #0099cc; 
        }
        .mesaj { 
            margin-top: 20px; 
            font-size: 18px; 
            color: yellow; 
        }
    </style>
</head>
<body>

<h2>Autentificare utilizator</h2>

<div class="login-box">
    <form method="post">
        <input type="text" name="username" placeholder="Utilizator" required><br>
        <input type="password" name="password" placeholder="Parola" required><br>

        <!-- AICI era problema: lipsea name="login" -->
        <button type="submit" name="login">🚀 Login</button>
    </form>
</div>

<?php 
if (!empty($mesaj)) { 
    echo "<div class='mesaj'>$mesaj</div>"; 
} 
?>

</body>
</html>
