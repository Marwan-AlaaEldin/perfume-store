<?php

class Database
{
    private static $host = "localhost";
    private static $db   = "classicmodelsnew";
    private static $user = "root";
    private static $pass = "";

    public static function connect()
    {
        $conn = new mysqli(self::$host,self::$user,self::$pass,self::$db);

        if ($conn->connect_error) {
            die("Database connection failed");
        }

        return $conn;
    }
}
