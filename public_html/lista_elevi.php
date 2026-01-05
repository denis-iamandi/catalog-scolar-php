<<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Aplicația de gestiune a elevilor</title>
    <style>
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            margin-top: 40px;
            padding: 20px;
            background-color: #f0f4f8;
            border-radius: 12px;
        }
        .logo-container img {
            width: 120px;
            transition: transform 0.3s ease;
        }
        .logo-container img:hover {
            transform: scale(1.1);
        }
        table {
            margin: auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
<?php
include("config.php");
$result = mysqli_query($conn, "SELECT * FROM elevi");
echo "<table>";
echo "<tr><th>ID</th><th>Nume</th><th>Prenume</th><th>Clasa</th><th>Email</th></tr>";
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['id_elev']."</td>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['prenume']."</td>";
    echo "<td>".$row['clasa']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
<div class="logo-container">
    <img src="img/logo_moldova.png" alt="Instituțiile preuniversitare din Moldova">
    <img src="img/logo_apache.png" alt="Apache">
    <img src="img/logo_mysql.png" alt="MySQL">
    <img src="img/logo_html_css_js.png" alt="HTML CSS JS">
</div>
</body>
</html>
