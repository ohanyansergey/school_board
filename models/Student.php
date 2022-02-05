<?php

class Student
{
    public static function getById($id)
    {
        $db = DB::connect();
        $user = $db->query('SELECT * FROM students WHERE id =' . addslashes($id));
        $user->setFetchMode(PDO::FETCH_ASSOC);
        return $user->fetch();
    }

    public static function getAvgGrade($id)
    {
        $db = DB::connect();
        $avgGrade = $db->query('SELECT AVG(grade) as grade FROM student_subject WHERE student_id =' . addslashes($id));
        $avgGrade->setFetchMode(PDO::FETCH_ASSOC);
        return $avgGrade->fetch();
    }

    public static function getListOfGrade($id)
    {
        $db = DB::connect();
        $query = 'SELECT subjects.name as subject, student_subject.grade
                FROM subjects
                INNER JOIN student_subject
                ON subjects.id = student_subject.subject_id
                WHERE student_subject.student_id = ' . addslashes($id);
        $list = $db->query($query);
        $list->setFetchMode(PDO::FETCH_ASSOC);
        return $list->fetchAll();
    }
}