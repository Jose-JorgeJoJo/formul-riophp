<?php
class Pessoa {
    public static function save($pessoa){
        $conn = mysqli_connect('localhost:3307', 'root', '', 'tarde_treinamento');
        if(empty($pessoa['id'])){
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch_assoc();
            $pessoa['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email)      
                    VALUES 
                        ('{$pessoa['id']}',
                        '{$pessoa['nome']}', 
                        '{$pessoa['endereco']}', 
                        '{$pessoa['bairro']}', 
                        '{$pessoa['telefone']}', 
                        '{$pessoa['email']}')";
        }
        else{
            $sql = "UPDATE pessoa SET 
                nome = '{$pessoa['nome']}', 
                endereco = '{$pessoa['endereco']}', 
                bairro = '{$pessoa['bairro']}', 
                telefone = '{$pessoa['telefone']}', 
                email = '{$pessoa['email']}'
                WHERE id ='{$pessoa['id']}'";
        }
        return $conn->query($sql);
    }
    public static function find($id){
        $conn = mysqli_connect('localhost:3307', 'root', '', 'tarde_treinamento');
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $conn->query("SELECT * FROM pessoa WHERE id='{$id}'");
        return $result->fetch();
    }
    public static function all(){
        $conn = mysqli_connect('localhost:3307', 'root', '', 'tarde_treinamento');
        

        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $list;
    }
    public static function delete($id){
        $conn = mysqli_connect('localhost:3307', 'root', '', 'tarde_treinamento');

        $result = $conn->query("DELETE FROM pessoa WHERE id='{$id}'");
        return($result);
    }
        
}