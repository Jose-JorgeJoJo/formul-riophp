<?php
class Pessoa{
    private static $conn;

    public static function getConnection(){
        if(empty(self::$conn)){
            $conn = mysqli_connect('localhost:3307', 'root', '', 'tarde_treinamento');
        }
        return self::$conn;
    }
    public static function save($pessoa)
}