<?php
class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "1234567890";
    private $database = "crud";
    private $conn;

    function __construct()
    {
        $this->conn = $this->connectDB();
    }

    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function readData($query)
    {
        $result = mysqli_query($this->conn, $query);
        $resultset = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        return $resultset;
    }

    function numRows($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function executeInsert($query)
    {
        $result = mysqli_query($this->conn, $query);
        $insert_id = mysqli_insert_id($this->conn);
        return $insert_id;
    }

    function cleanData($data)
    {
        $data = mysqli_real_escape_string($this->conn, strip_tags($data));
        return $data;
    }
}
