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
            'grades' => Student::getListOfGrade($student['id']),
            'avg' => $avgGrade['grade'],
            'finalResult' => $avgGrade['grade'] >= 7 ? 'Pass' : 'Fail'
        ];
        header('Content-Type: application/json');
        echo json_encode(['student' => $data]);
    }

    private function csmb($student)
    {
        $listOfGrades = Student::getListOfGrade($student['id']);
        $grades = [];
        foreach($listOfGrades as $listOfGrade) {
            $grades[$listOfGrade['subject']] = intval($listOfGrade['grade']);
        }

        if(count($grades) > 2) {
            asort($grades);
            array_shift($grades);
        }

        $xml = new SimpleXMLElement('<student/>');
        $xml->addChild('id', $student['id']);
        $xml->addChild('name', $student['name']);
        $gradesXml = $xml->addChild('grades');
        foreach ($grades as $key => $value) {
            $gradeXml = $gradesXml->addChild('grade');
            $gradeXml->addChild('subject', $key);
            $gradeXml->addChild('grade', $value);
        }

        $xml->addChild('avg', count($grades) ? array_sum($grades) / count($grades) : null);
        $xml->addChild('finalResult', (count($grades) && max($grades)) > 8 ? 'Pass' : 'Fail');
        header('Content-Type: text/xml');
        echo $xml->asXML();
    }
}