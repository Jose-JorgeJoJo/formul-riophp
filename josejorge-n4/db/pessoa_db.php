<?php
function lista_pessoas(){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $result = mysqli_query($conn, "SELECT * FROM pessoa ORDER BY id");
    $list = mysqli_fetch_all($result);
    mysqli_close($conn);
    return $list;
}

function exclui_pessoa($id){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id='{$id}'");
    mysqli_close($conn);
    return $result;
}

function get_pessoa($id){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
    $pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $pessoa;
}

function get_next_pessoa(){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
    $lastId = mysqli_fetch_assoc($result);
    $next = $lastId["next"] + 1;
    mysqli_close($conn);
    return $next;
}

function insert_pessoa($pessoa){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email)      
            VALUES 
                        ('{$pessoa['id']}','{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function update_pessoa($pessoa){
    $conn = mysqli_connect('localhost', 'root', '', 'treinamento');
    $sql = "UPDATE pessoa SET 
                nome = '{$pessoa['nome']}', 
                endereco = '{$pessoa['endereco']}', 
                bairro = '{$pessoa['bairro']}', 
                telefone = '{$pessoa['telefone']}', 
                email = '{$pessoa['email']}'
                WHERE id ='{$pessoa['id']}'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}