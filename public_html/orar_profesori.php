<?php
$conn = new mysqli("localhost", "root", "", "educatie");
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Orar și Profesori</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #003366, #005580, #0077aa, #0099cc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            padding: 40px;
            text-align: center;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            margin: 30px auto;
            width: 90%;
            background-color: #ffffff;
            color: #000;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #003366;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .buton-inapoi {
            margin-top: 30px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #005580;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .buton-inapoi:hover {
            background-color: #0077aa;
        }
    </style>
</head>
<body>

<h2>Orar complet cu profesori și discipline</h2>

<?php
$sql = "SELECT 
            o.ziua_saptamanii,
            o.ora,
            c.denumire AS clasa,
            d.denumire AS disciplina,
            CONCAT(p.nume, ' ', p.prenume) AS profesor
        FROM orar o
        JOIN clase c ON o.id_clasa = c.id_clasa
        JOIN discipline d ON o.id_disciplina = d.id_disciplina
        JOIN profesori p ON o.id_profesor = p.id_profesor
       ORDER BY FIELD(o.ziua_saptamanii, 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri'), o.ora";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Ziua</th><th>Ora</th><th>Clasa</th><th>Disciplina</th><th>Profesor</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ziua_saptamanii']}</td>
                <td>{$row['ora']}</td>
                <td>{$row['clasa']}</td>
                <td>{$row['disciplina']}</td>
                <td>{$row['profesor']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nu există înregistrări în orar.</p>";
}

$conn->close();
?>

<a href="prezentare.php" class="buton-inapoi">⬅ Înapoi la prezentare</a>

</body>
</html>
