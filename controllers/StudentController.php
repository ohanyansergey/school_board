<?php

class StudentController
{
    public function show($id)
    {
        $student = Student::getById($id);
        if(!$student) {
            echo 'Student not found'; die();
        }

         call_user_func([$this, $student['board_type']], $student);
    }

    private function csm($student)
    {
        header('Content-Type: application/json');
        echo json_encode(['name' => 'zz']);
    }

    private function csmb($student)
    {
        $xml = new SimpleXMLElement('<xml/>');
        $xmlChild = $xml->addChild('student');
        $xmlChild->addChild('id', 1);
        $xmlChild->addChild('name', 'essss');
        header('Content-Type: text/xml');
        echo $xml->asXML();
    }
}