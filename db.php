<?php

class Database
{
    private $dsn = "mysql:host=127.0.0.1;port=8889;dbname=php_oops_crud";
    private $user = "root";
    private $pass = "root";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection error
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insert($fname, $lname, $email, $phone)
    {
        try {
            $sql = "INSERT INTO users (first_name, last_name, email, phone) VALUES (:fname, :lname, :email, :phone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone]);
            return true;
        } catch (PDOException $e) {
            // Handle insert error
            echo "Insert Error: " . $e->getMessage();
            return false;
        }
    }

    public function read()
    {
        try {
            $data = array();
            $sql = 'SELECT * FROM users';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            // Handle read error
            echo "Read Error: " . $e->getMessage();
            return [];
        }
    }

    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle get user by ID error
            echo "Get User Error: " . $e->getMessage();
            return null;
        }
    }

    public function update($id, $fname, $lname, $email, $phone)
    {
        try {
            $sql = "UPDATE users SET first_name = :fname, last_name = :lname, email = :email, phone = :phone WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone, 'id' => $id]);
            return true;
        } catch (PDOException $e) {
            // Handle update error
            echo "Update Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            // Handle delete error
            echo "Delete Error: " . $e->getMessage();
            return false;
        }
    }

    public function totalRowCount()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $t_rows = $stmt->rowCount();
            return $t_rows;
        } catch (PDOException $e) {
            // Handle total row count error
            echo "Count Error: " . $e->getMessage();
            return 0;
        }
    }
}
?>
