<?php
// Função para validar CPF
function validarCPF($cpf) {
    // Remover caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verificar se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verificar se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Algoritmo de validação do CPF
    for ($i = 9, $j = 10, $soma = 0, $digito1 = 0, $digito2 = 0; $j >= 2; $i--, $j--) {
        $soma += $cpf[$i] * $j;
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    for ($i = 9, $j = 11, $soma = 0; $j >= 2; $i--, $j--) {
        $soma += $cpf[$i] * $j;
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verificar se os dígitos calculados são iguais aos dígitos informados
    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }

    return true;
}

// Função para validar CEP
function validarCEP($cep) {
    // Remover caracteres não numéricos
    $cep = preg_replace('/[^0-9]/', '', $cep);

    // Verificar se o CEP tem 8 dígitos
    if (strlen($cep) != 8) {
        return false;
    }

    return true;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar e validar os dados do formulário
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $cep = $_POST["cep"];
    $cartao = $_POST["cartao"];

    // Verificar se todos os campos estão preenchidos
    if (empty($nome) || empty($sobrenome) || empty($telefone) || empty($cpf) || empty($endereco) || empty($cep)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Validar CPF
        if (!validarCPF($cpf)) {
            echo "CPF inválido.";
        } else {
            // Validar CEP
            if (!validarCEP($cep)) {
                echo "CEP inválido.";
            } else {
                // Processar os dados 
                echo "Formulário enviado com sucesso!";
            }
        }
    }
}
?>
