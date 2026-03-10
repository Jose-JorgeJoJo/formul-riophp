<?php
$dados = $_POST;
if($dados['id']){
    $conn = mysqli_connect("localhost:3307","root","","tarde_treinamento");
    $sql = "UPDATE pessoa SET nome = '{$dados['nome']}', endereco = '{$dados['endereco']}', bairro = '{$dados['bairro']}', telefone = '{$dados['telefone']}', email = '{$dados['email']}' WHERE id = '{$dados['id']}'";
    $result = mysqli_query($conn, $sql);
    if($result){
        print "Registro atualizado com sucesso.";
    } else{
        print mysqli_error_list($conn);
    }
    mysqli_close($conn);
}