<?php
if(!empty($_REQUEST['action'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    if($_REQUEST['action'] == 'edit'){
        $id = (int) $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
        $pessoa = mysqli_fetch_assoc($result);
    }
    else if ($_REQUEST['action'] == 'save'){
        $pessoa = $_POST;
        if(empty($_POST['id'])){
            $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
                $lastId = mysqli_fetch_assoc($result);
                $next = $lastId["next"] + 1;
                $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email) VALUES 
                ('{$next}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}')";
                $result = mysqli_query($conn, $sql);
        }
        else{
            $sql = "UPDATE pessoa SET 
                nome = '{$pessoa['nome']}', 
                endereco = '{$pessoa['endereco']}', 
                bairro = '{$pessoa['bairro']}', 
                telefone = '{$pessoa['telefone']}', 
                email = '{$pessoa['email']}'
                WHERE id ='{$pessoa['id']}'";
                $result = mysqli_query($conn, $sql);

            }
            print ($result) ? 'Registro salvo com sucesso.' : mysqli_error_list($conn);
            mysqli_close($conn);
    }
}
else{
    $pessoa = [];
    $pessoa['id'] = '';
    $pessoa['nome'] = '';
    $pessoa['endereco'] = '';
    $pessoa['bairro'] = '';
    $pessoa['telefone'] = '';
    $pessoa['email'] = '';
}

$form = file_get_contents('html/form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
print $form;