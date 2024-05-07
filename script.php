<?php
session_start();

// Inicializa o histórico
if (!isset($_SESSION['historico'])) {
    $_SESSION['historico'] = array();
}

class Calculadora {
    public function calcular($num1, $num2, $op) {
        switch ($op) {
            case '+':
                return $num1 + $num2;
            case '-':
                return $num1 - $num2;
            case '*':
                return $num1 * $num2;
            case '/':
                if ($num2 != 0) {
                    return $num1 / $num2;
                } else {
                    return "Erro: Divisão por zero.";
                }
            case '^':
                return pow($num1, $num2);
            case 'n!':
                return $this->fatorial($num1);
            default:
                return "Operação inválida";
        }
    }
    
    private function fatorial($n) {
        if ($n == 0) {
            return 1;
        } else {
            return $n * $this->fatorial($n - 1);
        }
    }
}

// Verificação submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificação botão de limpar histórico
    if (isset($_POST['limpar'])) {
        // Limpa o histórico armazenado na sessão
        $_SESSION['historico'] = array();
    }
    // Verificação botão de calcular
    if (isset($_POST['calcular'])) {
        // Verificar se os campos foram preenchidos
        if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['op'])) {
            // pegar os valores dos campos
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $op = $_POST['op'];

            // Criação da instância
            $calculadora = new Calculadora();
            
            //cálculo
            $result = $calculadora->calcular($num1, $num2, $op);

            // Adicionar cálculo no histórico
            $_SESSION['historico'][] = "$num1 $op $num2 = $result";
            
            // Salva os valores no formulário
            $_SESSION['num1'] = $num1;
            $_SESSION['num2'] = $num2;
            $_SESSION['op'] = $op;
        }
    }
    // Verificação botão de M
    if (isset($_POST['salvar_pegar'])) {
        // Se os valores estão na sessão, coloca-os de volta nos campos do formulário
        if (isset($_SESSION['num1']) && isset($_SESSION['num2']) && isset($_SESSION['op'])) {
            $_POST['num1'] = $_SESSION['num1'];
            $_POST['num2'] = $_SESSION['num2'];
            $_POST['op'] = $_SESSION['op'];
        } else {
            // Se não estiverem na sessão, salva os valores do formulário na sessão
            $_SESSION['num1'] = $_POST['num1'];
            $_SESSION['num2'] = $_POST['num2'];
            $_SESSION['op'] = $_POST['op'];
        }
    }
}
?>