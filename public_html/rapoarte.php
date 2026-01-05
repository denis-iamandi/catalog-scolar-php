<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "educatie");
if (!$conn) {
    die("Eroare conexiune: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<title>📊 Rapoarte absențe</title>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #e6f0ff;
    padding: 30px;
}

h2 {
    color: #003366;
    margin-top: 40px;
}

.container {
    background-color: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    max-width: 900px;
    margin: auto;
    margin-bottom: 40px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
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

input[type="number"] {
    padding: 8px;
    width: 120px;
    border-radius: 6px;
    border: 1px solid #aaa;
}

.buton {
    display: inline-block;
    padding: 10px 20px;
    background-color: #003366;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    margin-top: 10px;
}

.buton:hover {
    background-color: #0055aa;
}
</style>
</head>
<body>

<div class="container">
<h2>📌 Raport 1: Absențe pe elev / clasă / disciplină</h2>

<table>
<tr>
    <th>ID Elev</th>
    <th>Clasa</th>
    <th>Disciplina</th>
    <th>Data</th>
    <th>Motivată</th>
</tr>

<?php
$sql = "SELECT absente.*, elevi.clasa 
        FROM absente 
        JOIN elevi ON absente.id_elev = elevi.id_elev
        ORDER BY elevi.clasa, absente.id_elev, absente.disciplina";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id_elev']."</td>";
    echo "<td>".$row['clasa']."</td>";
    echo "<td>".$row['disciplina']."</td>";
    echo "<td>".$row['data_absentei']."</td>";
    echo "<td>".($row['motivata'] ? 'Da' : 'Nu')."</td>";
    echo "</tr>";
}
?>
</table>
</div>


<div class="container">
<h2>📌 Raport 2: Total absențe nemotivate</h2>

<table>
<tr>
    <th>ID Elev</th>
    <th>Total nemotivate</th>
</tr>

<?php
$sql = "SELECT id_elev, COUNT(*) AS total
        FROM absente
        WHERE motivata = 0
        GROUP BY id_elev
        ORDER BY total DESC";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id_elev']."</td>";
    echo "<td>".$row['total']."</td>";
    echo "</tr>";
}
?>
</table>
</div>


<div class="container">
<h2>📌 Raport 3: Elevi cu peste X absențe</h2>

<form method="GET">
    <label>Introduceți numărul X:</label>
    <input type="number" name="x" value="<?php echo isset($_GET['x']) ? $_GET['x'] : 5; ?>">
    <input type="submit" value="Filtrează">
</form>

<table>
<tr>
    <th>ID Elev</th>
    <th>Total absențe</th>
</tr>

<?php
$x = isset($_GET['x']) ? $_GET['x'] : 5;

$sql = "SELECT id_elev, COUNT(*) AS total
        FROM absente
        GROUP BY id_elev
        HAVING total > $x
        ORDER BY total DESC";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id_elev']."</td>";
    echo "<td>".$row['total']."</td>";
    echo "</tr>";
}
?>
</table>
</div>


<div class="container">
<h2>📌 Raport 4: Justificări medicale</h2>

<table>
<tr>
    <th>ID Elev</th>
    <th>Data</th>
    <th>Disciplina</th>
    <th>Justificare</th>
</tr>

<?php
$sql = "SELECT * FROM absente WHERE motivata = 1 AND justificare != ''";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id_elev']."</td>";
    echo "<td>".$row['data_absentei']."</td>";
    echo "<td>".$row['disciplina']."</td>";
    echo "<td>".$row['justificare']."</td>";
    echo "</tr>";
}
?>
</table>
</div>


<div class="container">
<h2>📌 Raport 5: Export Excel</h2>

<p>Alege formatul de export:</p>

<a href="export_excel.php" class="buton">📄 Export Excel</a>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>
