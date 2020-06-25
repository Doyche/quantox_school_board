<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Classes;

use MyApp\Model\Student;
use MyApp\Model\Grade;

class BoardCalculator
{
    private $Student;
    private $Grade;

    public function __construct()
    {
        $this->Grade = new Grade();
        $this->Student = new Student();
    }

    public function getAverage($grades)
    {
        $sum = array_sum($grades);
        $average = $sum / sizeof($grades);

        return $average;
    }

    public function getSudent($student_id)
    {
        $student = $this->Student->getStudent($student_id);

        return $student;
    }

    public function getGrades($student_id)
    {
        $grades = array();

        $student_grades = $this->Grade->getStudentGrades($student_id);

        foreach($student_grades as $sg){
            array_push($grades, $sg->grade);
        }

        return $grades;
    }
}