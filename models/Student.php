<?php

class Student
{
    public static function getById($id)
    {
        $db = DB::connect();
        $user = $db->query('SELECT * FROM students WHERE id =' . $id);
        $user->setFetchMode(PDO::FETCH_ASSOC);
        return $user->fetch();
    }
}