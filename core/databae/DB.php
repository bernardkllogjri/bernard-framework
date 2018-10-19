<?php


class DB{
    private static $connection = null;
    const FETCH_TYPE = PDO::FETCH_OBJ;

    public static function init($db){
        static::$connection = $db;
    }

    public static function raw($statement,$data=[]){

        $prepared_statement = static::$connection->prepare($statement);
        $prepared_statement->execute($data);

        return $prepared_statement->fetch(static::FETCH_TYPE);

    }
}
