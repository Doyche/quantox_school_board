<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Model;

use MyApp\Database\Connection;

/**
 * Class SchoolBoard
 * @package MyApp\Model
 */
class SchoolBoard
{
    use Connection;
	private $message;

    /**
     * SchoolBoard constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return mixed
     */
    public function getAllBoards()
    {
		$sql = "SELECT * FROM school_boards";
        $query = $this->conn->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @return string
     */
    public function GetMessage() : string
    {
        return $this->message;
    }
}