<?php

function validarCPF($cpf) {
    
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    
    if (strlen($cpf) != 11) {
        return false;
    }

   
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    
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

    
    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }

    return true;
}


function validarCEP($cep) {
    
    $cep = preg_replace('/[^0-9]/', '', $cep);

  
    if (strlen($cep) != 8) {
        return false;
    }

    return true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $cep = $_POST["cep"];
    $cartao = $_POST["cartao"];

    
    if (empty($nome) || empty($sobrenome) || empty($telefone) || empty($cpf) || empty($endereco) || empty($cep)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
    } else {
     
        if (!validarCPF($cpf)) {
            echo "CPF inválido.";
        } else {
      
            if (!validarCEP($cep)) {
                echo "CEP inválido.";
            } else {
            
                echo "Formulário enviado com sucesso!";
            }
        }
    }
}
?>
