<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Controller;

use MyApp\Model\Student;
use MyApp\Model\Grade;
use MyApp\Classes\CSM;
use MyApp\Classes\CSMB;
use MyApp\Classes\Outputter;


/**
 * Class IndexController
 * @package MyApp\Controller
 */
class IndexController
{
    /**
     * @var Student
     */
    private $Student;
    private $Grade;
    private $CSM;
    private $CSMB;

    /**
     * Constructor initialize objects of models
     */

    public function __construct()
    {
		$this->Student = new Student();
		$this->Grade = new Grade();
		$this->CSM = new CSM();
		$this->CSMB = new CSMB();
    }

    /**
     *  Show all students
     */
    public function getAll()
    {
		$students = $this->Student->getAllStudents();
		echo '<pre>';
		var_dump($students);
		echo '</pre>';
	}

    /**
     * Show specific student
     * @param $id
     */
    public function show($id)
    {
		$student = $this->Student->getStudent($id);

        $outputer = new Outputter($student);
        $outputer->getResult();
		
		/*if($student->school_board_id == '1')
        {
            $result = $this->CSM->getBoardResult($student->id);
            echo $result;
		} elseif($student->school_board_id == '2'){
			$result = $this->CSMB->getBoardResult($student->id);
            echo $result;
		}*/
	}

    /**
     *  Store student
     */
    public function store()
    {	
		$name = "Vladimir Dojčinović";
		$school_board_id = "1";
		$grades = [6, 8, 8, 9];

		if(sizeof($grades) <= 4){
            $student_id = $this->Student->insertStudent([
                'name' => $name,
                'school_board_id' => $school_board_id
            ]);

            foreach($grades as $grade){
                $this->Grade->insertGrade([
                    'student_id' => $student_id,
                    'grade' => $grade
                ]);
            }

            if(!empty($student_id)){
                $status = true;
            }else{
                $status = false;
            }

        } else {
            $status = false;
        }

        $message = $this->Student->GetMessage();

        $data = array(
            'message' => $message,
            'status' => $status
        );

        echo json_encode($data);
	}
	
}