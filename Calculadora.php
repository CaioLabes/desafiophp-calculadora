<?php
    require_once "script.php"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora PHP</title>
</head>
<body>
    <div class="calculadora">
        <h2>Calculadora PHP</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="num1">Número 1:</label><br>
            <input type="number" id="num1" name="num1" value="<?php if(isset($_POST['num1'])) echo $_POST['num1']; ?>" ><br><br>
            <label for="op">Operador:</label><br>
            <select id="op" name="op">
                <option value="+" <?php if(isset($_POST['op']) && $_POST['op'] == '+') echo 'selected'; ?>>+</option>
                <option value="-" <?php if(isset($_POST['op']) && $_POST['op'] == '-') echo 'selected'; ?>>-</option>
                <option value="*" <?php if(isset($_POST['op']) && $_POST['op'] == '*') echo 'selected'; ?>>*</option>
                <option value="/" <?php if(isset($_POST['op']) && $_POST['op'] == '/') echo 'selected'; ?>>/</option>
                <option value="^" <?php if(isset($_POST['op']) && $_POST['op'] == '^') echo 'selected'; ?>>^</option>
                <option value="n!" <?php if(isset($_POST['op']) && $_POST['op'] == 'n!') echo 'selected'; ?>>n!</option>
            </select><br><br>
            <label for="num2">Número 2:</label><br>
            <input type="number" id="num2" name="num2" value="<?php if(isset($_POST['num2'])) echo $_POST['num2']; ?>" ><br><br>
            <input type="submit" name="calcular" value="Calcular">
            <input type="submit" name="salvar" value="Salvar">
            <input type="submit" name="pegar" value="Pegar">
            <input type="submit" name="limpar" value="Limpar Histórico">
        </form>

        <h2>Histórico de Operações</h2>
        <?php
        if (!empty($_SESSION['historico'])) {
            echo "<ul>";
            foreach ($_SESSION['historico'] as $calc) {
                echo "<li>$calc</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nenhuma operação realizada ainda.</p>";
        }
        ?>
    </div>
</body>
</html>
