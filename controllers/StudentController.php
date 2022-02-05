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
        $avgGrade = Student::getAvgGrade($student['id']);
        $data = [
            'id' => $student['id'],
            'name' => $student['name'],
            'listOfGrades' => Student::getListOfGrade($student['id']),
            'avg' => $avgGrade['grade'],
            'finalResult' => $avgGrade['grade'] >= 7 ? 'Pass' : 'Fail'
        ];
        header('Content-Type: application/json');
        echo json_encode(['student' => $data]);
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