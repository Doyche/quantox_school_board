<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Model;

use MyApp\Database\Connection;

/**
 * Class Grade
 * @package MyApp\Model
 */
class Grade
{
    use Connection;
	private $message;

    /**
     * Grade constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return mixed
     */
    public function getAllGrades()
    {
		$sql = "SELECT * FROM grades";
        $query = $this->conn->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStudentGrades($id)
    {
		$sql = "SELECT * FROM grades INNER JOIN students ON grades.student_id = students.id WHERE students.id = :id";
        $query = $this->conn->prepare($sql);
        $query->execute(Array(':id' => $id));

        return $query->fetchAll();
    }

    /**
     * @param $params
     * @return bool
     */
    public function insertGrade($params) : bool
    {
		//$name = strip_tags($_POST['name']);
		//$school_board_id = strip_tags($_POST['school_board_id']);
		$student_id = $params['student_id'];
		$grade = $params['grade'];
		
		if (empty($student_id)){
			$this->message = 'student_id nije unet!';
			return false;
		}
		
		if (empty($grade)){
			$this->message = 'grade nije unet!';
			return false;
		}
			
		$sql = 'INSERT INTO students (student_id, grade) VALUES (:student_id, :grade)';
		$query = $this->conn->prepare($sql);
		$query->execute(array(':student_id' => $student_id,
							  ':grade' => $grade));

		if ($query->rowCount() == 1) {
			$this->message = 'Uspešno ste dodali!';
			return true;
		}
		
		return false;
	}

    /**
     * @return string
     */
    public function GetMessage() : string
    {
        return $this->message;
    }
}