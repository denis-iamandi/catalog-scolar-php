<?php
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<title>Note elevi</title>

<style>
body { background:#f2e9f7; font-family:Arial; }

/* FORMULAR */
.form-note {
    width: 420px; margin: 30px auto; padding: 20px;
    background:#f8f0ff; border:2px solid #6c3483; border-radius:10px;
}
.form-note h2 { text-align:center; color:#6c3483; margin-bottom:15px; }
.form-note label { margin-top:12px; font-weight:bold; color:#4a235a; display:block; }
.form-note input, .form-note select {
    width:100%; padding:8px; margin-top:5px;
    border:1px solid #bfa3d6; border-radius:5px;
}
.form-note input[type="submit"] {
    background:#6c3483; color:white; border:none; padding:10px;
    margin-top:18px; cursor:pointer; border-radius:5px;
}

/* MESAJE */
.msg { width:420px; margin:15px auto; text-align:center; padding:8px; border-radius:5px; }
.success { background:#d4efdf; color:#1e8449; }
.error { background:#f5b7b1; color:#922b21; }

/* TABEL NOTE */
.table-box { width:80%; margin:40px auto; }
.table-box h3 { text-align:center; color:#6c3483; margin-bottom:15px; }
table {
    width:100%; border-collapse:collapse; background:white;
}
table th {
    background:#e8daef; padding:10px; border:1px solid #ccc; text-align:center;
}
table td {
    padding:8px; border:1px solid #ccc;
}
</style>
</head>

<body>

<!-- FORMULAR -->
<div class="form-note">
<h2>Introducere note elevi</h2>

<form method="POST" action="note.php">
    <label>Elev:</label>
    <select name="id_elev" required>
        <?php
        $elevi = mysqli_query($conn, "SELECT id_elev, nume, prenume FROM elevi ORDER BY nume");
        while ($e = mysqli_fetch_assoc($elevi)) {
            echo "<option value='{$e['id_elev']}'>{$e['nume']} {$e['prenume']}</option>";
        }
        ?>
    </select>

    <label>Disciplina:</label>
    <input type="text" name="disciplina" required>

    <label>Nota:</label>
    <input type="number" name="nota" min="1" max="10" step="0.01" required>

    <label>Data:</label>
    <input type="date" name="data_nota" required>

    <input type="submit" name="submit" value="Salvează nota">
</form>
</div>

<?php
/* INSERARE NOTĂ */
if (isset($_POST['submit'])) {
    $id_elev = $_POST['id_elev'];
    $disciplina = $_POST['disciplina'];
    $nota = $_POST['nota'];
    $data = $_POST['data_nota'];

    $sql = "INSERT INTO note (id_elev, disciplina, nota, data_nota)
            VALUES ('$id_elev', '$disciplina', '$nota', '$data')";

    echo mysqli_query($conn, $sql)
        ? "<div class='msg success'>Nota a fost salvată!</div>"
        : "<div class='msg error'>Eroare: " . mysqli_error($conn) . "</div>";
}
?>

<!-- TABEL NOTE -->
<div class="table-box">
<h3>Evidența notelor înregistrate</h3>

<table>
    <tr>
        <th>Elev</th>
        <th>Disciplina</th>
        <th>Nota</th>
        <th>Data</th>
    </tr>

    <?php
    $sql = "SELECT e.nume, e.prenume, n.disciplina, n.nota, n.data_nota
            FROM note n
            JOIN elevi e ON n.id_elev = e.id_elev
            ORDER BY n.data_nota DESC";

    $rez = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($rez)) {
        echo "<tr>
                <td>{$row['nume']} {$row['prenume']}</td>
                <td>{$row['disciplina']}</td>
                <td style='text-align:center;'>{$row['nota']}</td>
                <td style='text-align:center;'>{$row['data_nota']}</td>
              </tr>";
    }
    ?>
</table>
</div>

</body>
</html>
