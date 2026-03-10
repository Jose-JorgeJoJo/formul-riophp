<?php
$dados = $_POST;
$conn = mysqli_connect("localhost:3307","root","","tarde_treinamento");
$result = mysqli_query($conn,"SELECT max(id) as next FROM pessoa");
var_dump($result);
$lastId = mysqli_fetch_assoc($result);
$next = $lastId["next"] + 1;
$sql = 
"INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email) 
VALUES 
('{$next}', '{$dados['nome']}', '{$dados['endereco']}', '{$dados['bairro']}', '{$dados['telefone']}', '{$dados['email']}')";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo 'Registro inserido com sucesso';
    print '<br><a href="pessoa_form_insert.php"><button>Retornar ao formulário</button></a>';
}else {
    echo mysqli_error_list($conn);
}

mysqli_close($conn);