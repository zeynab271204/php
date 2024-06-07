<!DOCTYPE html>
<html>
<head>
    <title>Calculatrice PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        #calculator {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
        }
        label, input, select, button {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="calculator">
        <h2>Calculatrice</h2>
        <form method="post" action="">
            <label for="num1">Nombre 1 :</label>
            <input type="text" id="num1" name="num1">
            <label for="operation">Opération :</label>
            <select id="operation" name="operation">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*0"></option>
                <option value="/">/</option>
            </select>
            <label for="num2">Nombre 2 :</label>
            <input type="text" id="num2" name="num2">
            <button type="submit">Calculer</button>
        </form>
<?php
echo "bonjour abdellatif";
?>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operation = $_POST["operation"];

            switch ($operation) {
                case "+":
                    $resultat = $num1 + $num2;
                    break;
                case "-":
                    $resultat = $num1 - $num2;
                    break;
                case "*":
                    $resultat = $num1 * $num2;
                    break;
                case "/":
                    if ($num2 != 0) {
                        $resultat = $num1 / $num2;
                    } else {
                        $resultat = "Division par zéro";
                    }
                    break;
                default:
                    $resultat = "Opération non valide";
            }

            echo "<p>Résultat : $resultat</p>";
        }
        ?>
    </div>
</body>
</html>
