<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Classes;

use Sabre\Xml\Service;

class Outputter
{
    protected $student;

    public function __construct($student) {
        $this->student = $student;
    }

    public function getResult(){
        if($this->student->school_board_id == '1')
        {
            $csm = new CSM();
            $result = $csm->getBoardResult($this->student->id);
            $this->JSON($result);

        } elseif($this->student->school_board_id == '2'){
            $csmb = new CSMB();
            $result = $csmb->getBoardResult($this->student->id);
            $this->XML($result);
        }
    }

    public function JSON($response) {
        echo header('Content-Type: application/json') . json_encode($response);
    }

    public function XML($response) {
        $service = new Service();

        echo header('Content-Type: text/xml') . $service->write('CSMB', [
                'student_name' => $response['name'],
                'grades' => implode(', ', $response['grades']),
                'average' => $response['average'],
                'result' => $response['result'],
                ]);
    }
}