<?php

Class Database{

    private $dsn = 'mysql:host=localhost;dbname=php_oops_crud';
    private $user = 'root';
    private $pass = '';
    public $conn;

    public function __construct(){

        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
            //echo 'connected';
        } catch (Throwable $th) {
            echo $th;
        }
        
    }

    public function read(){

        $columns = array(
            0 => 'id',
            1 => 'fname', 
            2 => 'lname',
            3 => 'created_at'
        );

        $query = "SELECT * FROM users";

        if (!empty($_POST['search']['value'])){
            $searchedVar = $_POST["search"]["value"];
            $query .= " WHERE fname LIKE '%".$searchedVar."%' OR lname LIKE '%". $searchedVar."%' ";
        }

        if (isset($_POST['order'])) {
        
            $query .= " ORDER BY ". $columns[$_POST['order'][0]['column']]. " ".$_POST['order'][0]['dir'];
        }

        if ($_POST['length']) {
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            $query .= " LIMIT $limit OFFSET $offset";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function get_all_data(){

        $query = "SELECT * FROM users";
        
        if (!empty($_POST['search']['value'])){
            $searchedVar = $_POST["search"]["value"];
            $query .= " WHERE fname LIKE '%".$searchedVar."%' OR lname LIKE '%". $searchedVar."%' ";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
        
    }

    public function destroy($id){

        $query = "DELETE FROM users WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function adduser($fname, $lname){

        $query = "INSERT INTO users (fname, lname) VALUES(:fname, :lname)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':fname' => $fname, 
                        ':lname' => $lname]);

    }
    
}