<?php

class DB
{
    public static function connect()
    {
        $hostname = 'localhost';
        $dbname = 'school_board';
        $username = 'root';
        $password = '';
        $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        return $db;
    }

}