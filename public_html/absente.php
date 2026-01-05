<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conectare la baza de date
$conn = mysqli_connect("localhost", "root", "", "educatie");
if (!$conn) {
    die("Eroare conexiune: " . mysqli_connect_error());
}

// Inserare absență
if (isset($_POST['submit'])) {
    $id_elev = $_POST['id_elev'];
    $data = $_POST['data_absentei'];
    $disciplina = $_POST['disciplina'];
    $motivata = $_POST['motivata'];
    $justificare = $_POST['justificare'];

    $sql = "INSERT INTO absente (id_elev, data_absentei, disciplina, motivata, justificare)
            VALUES ('$id_elev', '$data', '$disciplina', '$motivata', '$justificare')";

    if (mysqli_query($conn, $sql)) {
        $mesaj = "<div class='succes'>✔️ Absența a fost înregistrată cu succes!</div>";
    } else {
        $mesaj = "<div class='eroare'>❌ Eroare: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>📌 Evidență absențe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f0ff;
            padding: 30px;
        }

        h2 {
            color: #003366;
        }

        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 700px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #003366;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0055aa;
        }

        .succes, .eroare {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .succes {
            background-color: #d4edda;
            color: #155724;
        }

        .eroare {
            background-color: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>📌 Înregistrare absență</h2>

    <?php if (isset($mesaj)) echo $mesaj; ?>

    <form method="POST" action="">
        <label>ID Elev:</label>
        <input type="number" name="id_elev" required>

        <label>Data absenței:</label>
        <input type="date" name="data_absentei" required>

        <label>Disciplina:</label>
        <input type="text" name="disciplina" required>

        <label>Motivată:</label>
        <select name="motivata">
            <option value="0">Nemotivată</option>
            <option value="1">Motivată</option>
        </select>

        <label>Justificare (opțional):</label>
        <textarea name="justificare" rows="3"></textarea>

        <input type="submit" name="submit" value="Înregistrează">
    </form>
</div>

<div class="container">
    <h2>📋 Lista absențelor</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>ID Elev</th>
            <th>Data</th>
            <th>Disciplina</th>
            <th>Motivată</th>
            <th>Justificare</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM absente ORDER BY data_absentei DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['id_elev']."</td>";
            echo "<td>".$row['data_absentei']."</td>";
            echo "<td>".$row['disciplina']."</td>";
            echo "<td>".($row['motivata'] ? 'Da' : 'Nu')."</td>";
            echo "<td>".$row['justificare']."</td>";
            echo "</tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
</div>

</body>
</html>
