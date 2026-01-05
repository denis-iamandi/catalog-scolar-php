<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă elev</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
            text-align: center;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"], input[type="email"] {
            width: 250px;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #005580;
        }
    </style>
</head>
<body>

    <h2>Formular pentru adăugarea unui elev</h2>

    <form action="procesare.php" method="post">
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required>

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required>

        <label for="clasa">Clasa:</label>
        <input type="text" name="clasa" id="clasa" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <input type="submit" value="Adaugă elev">
    </form>

</body>
</html>
