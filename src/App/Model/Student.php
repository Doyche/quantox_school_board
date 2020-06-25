<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Model;

use MyApp\Database\Connection;

/**
 * Class Student
 * @package MyApp\Model
 */
class Student
{
    use Connection;

    private $message;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return mixed
     */
    public function getAllStudents()
    {
		$sql = "SELECT * FROM students";
        $query = $this->conn->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStudent($id)
    {
		$sql = "SELECT * FROM students WHERE id = :id Limit 1";
        $query = $this->conn->prepare($sql);
        $query->execute(Array(':id' => $id));

        return $query->fetch();
    }

    /**
     * @param $params
     * @return bool
     */
    public function insertStudent($params)
    {
		//$name = strip_tags($_POST['name']);
		//$school_board_id = strip_tags($_POST['school_board_id']);
		$name = $params['name'];
		$school_board_id = $params['school_board_id'];
		
		if (empty($name)){
			$this->message = 'Name nije unet!';
			return false;
		}
		
		if (empty($school_board_id)){
			$this->message = 'School_board_id nije unet!';
			return false;
		}
			
		$sql = 'INSERT INTO students (name, school_board_id) VALUES (:name, :school_board_id)';
		$query = $this->conn->prepare($sql);
		$query->execute(array(':name' => $name,
							  ':school_board_id' => $school_board_id));

		if ($query->rowCount() == 1) {
			$this->message = 'Uspešno ste dodali studenta!';
			return $this->conn->lastInsertId();
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