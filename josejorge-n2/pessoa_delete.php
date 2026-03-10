<?php
$dados = $_GET;
if(!empty($dados[id])) {
    $conn = mysqli_connect("localhost:3307","root","","tarde_treinamento");
    $sql = "DELETE FROM pessoa WHERE id='{$dados['id']}'";
    $result = mysqli_fetch_assoc($conn, $sql);
    if($result) {
        print 'Registro excluído com sucesso.';
    }else{
        print mysqli_error_list($conn);
    }
    mysqli_close($conn);
}