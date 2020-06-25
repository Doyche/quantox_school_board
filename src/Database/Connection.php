<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Database;
use PDO;
use PDOException;

/**
 * Trait Connection
 * @package MyApp\Database
 */
trait Connection
{
    protected $conn;

    /**
     *  Database connect
     */
    public function connect(){
        $AppConfig = parse_ini_file('.env');
        $type = $AppConfig['DB_TYPE'];
        $host = $AppConfig['DB_HOST'];
        $database = $AppConfig['DB_DATABASE'];
        $username = $AppConfig['DB_USERNAME'];
        $password = $AppConfig['DB_PASSWORD'];
        $dsn = "{$type}:host={$host};dbname={$database}";
		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            $this->conn = new PDO($dsn, $username, $password, $options);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec('SET NAMES utf8');
            $this->conn->exec('SET CHARACTER SET utf8');
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}