<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Classes;


class CSMB extends BoardCalculator implements BoardOutputInterface
{

	public function __construct()
	{
        parent::__construct();
	}

	public function getBoardResult($student_id)
	{
        $student = $this->getSudent($student_id);
        $grades = $this->getGrades($student_id);

		if(sizeof($grades) > 2) {
            sort($grades);
            array_shift($grades);
        }

        $average = $this->getAverage($grades);
        $result = max($grades) > 8 ? 'Pass' : 'Fail';

        $response = array(
            'name' =>  $student->name,
            'grades' => $grades,
            'average' => $average,
            'result' => $result
        );

        return $response;
	}



}
