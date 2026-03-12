<?php
class Pessoa{
    private static $conn;

    public static function getConnection(){
        if(empty(self::$conn)){
            $ini = parse_ini_file(__DIR__ . '/../config/livro.ini');
            
            self::$conn = new mysqli(
                $ini['host'], 
                $ini['user'], 
                $ini['pass'], 
                $ini['name'], 
                $ini['port']);
        }
        return self::$conn;
    }
    public static function save($pessoa){
    $conn = self::getConnection();

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
        $conn = self::getConnection();

        $result = $conn->query("SELECT * FROM pessoa WHERE id='{$id}'");
        return $result->fetch_assoc();
    }
    public static function all(){
        $conn = self::getConnection();
        

        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $list;
    }
    public static function delete($id){
        $conn = self::getConnection();

        $result = $conn->query("DELETE FROM pessoa WHERE id='{$id}'");
        return($result);
    }
}