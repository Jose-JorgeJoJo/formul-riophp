<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
</head>
<?php
$id = $nome = $endereco = $bairro = $telefone = $email = '';

if(!empty($_REQUEST['action'])){
    $conn = mysqli_connect("localhost:3307","root","","tarde_treinamento");
    if($_REQUEST['action'] == 'edit'){
        $id = (int) $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
        if ($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $nome = $row['nome'];
            $endereco = $row['endereco'];
            $bairro = $row['bairro'];
            $telefone = $row['telefone'];
            $email = $row['email'];
        }
    } else if($_REQUEST['action'] == 'save'){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $bairro = $_POST['bairro'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            if(empty($_POST['id'])){
                $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
                $lastId = mysqli_fetch_assoc($result);
                $next = $lastId["next"] + 1;
                $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email) VALUES 
                ('{$next}', '{$nome}', '{$endereco}', '{$bairro}', '{$telefone}', '{$email}')";
                $result = mysqli_query($conn, $sql);
            } 
            else{
                $sql = "UPDATE pessoa SET 
                nome = '{$nome}', 
                enderecco = '{$endereco}', 
                bairro = '{$bairro}', 
                telefone = '{$telefone}', 
                email = '{$email}'
                WHERE id ='{$id}'";
                $result = mysqli_query($conn, $sql);

            }
            print ($result) ? 'Registro salvo com sucesso.' : mysqli_error_list($conn);
            mysqli_close($conn);
    }
}
?>
<body>

    <form enctype="multipart/form-data" method="post" action="pessoa_form.php?" action=save>
        <label>Código</label>
        <input name="id" readonly="1" type="text" style="width: 30%" value="<?=$id?>">
        <label>Nome</label>
        <input name="nome" type="text" style="width: 30%" value="<?=$nome?>">
        <label>Endereço</label>
        <input name="endereco" type="text" style="width: 50%" value="<?=$endereco?>">
        <label>Bairro</label>
        <input name="bairro" type="text" style="width: 30%" value="<?=$bairro?>">
        <label>Telefone</label>
        <input name="telefone" type="text" style="width: 30%" value="<?=$telefone?>">
        <label>Email</label>
        <input name="email" type="text" style="width: 30%" value="<?=$email?>">
        <input type="submit">



</form>
    
</body>
</html>