<?php
class Drivers{
    private $connection;
    private $table = "drivers";
    public $filter = '';

    public $page_limit = 10;
    public $page;
    public $starting_limit;
    public $total_results;
    public $total_pages;


    public function __construct($database){
        $this->connection = $database;
    }

    public function setFilter($value){
        return $this->filter = $value;
    }

    public function index(){
        $this->pagination();
        $this->setTotalPages();
        $this->setPage();
        $this->setStartingLimit();

        $querystring = "SELECT * FROM $this->table";
        if(!empty($this->filter)){
            $querystring .= " WHERE driver_id LIKE '%$this->filter%' OR dr_emp_id LIKE '%$this->filter%' OR dr_name LIKE '%$this->filter%' OR dr_office LIKE '%$this->filter%' OR dr_status LIKE '%$this->filter%'";
        }
        $querystring .= " ORDER BY driver_id DESC LIMIT $this->starting_limit, $this->page_limit";
        $statement = $this->connection->query($querystring);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function pagination(){
        $querystring = "SELECT count(driver_id) FROM $this->table";
        $statement = $this->connection->query($querystring);
        return $this->total_results = $statement->fetchColumn();
    }

    public function setTotalPages(){
        return $this->total_pages = ceil($this->total_results / $this->page_limit);
    }

    public function setPage(){
        return $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
    }

    public function setStartingLimit(){
        return $this->starting_limit = ($this->page - 1) * $this->page_limit;
    }
    
    public function create($request){
        $this->connection->beginTransaction();
        $data = [];
        foreach($request as $key => $value) {
            if($key != 'submit' && $key != 'driver_id'){
                if(empty($value)) return "$key field is required";
                $data[$key] = strip_tags($value);
            } 
        }
        try{
            $querystring = "INSERT INTO $this->table (dr_emp_id, dr_name, dr_office, dr_status) VALUES (:dr_emp_id, :dr_name, :dr_office, :dr_status)";
            $statement= $this->connection->prepare($querystring);
            $statement->execute($data);
            $this->connection->commit();
            return 'Driver has successfully created!';
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!";
        }
    }

    public function edit($id){
        $querystring = "SELECT * FROM $this->table WHERE driver_id = $id";
        $statement = $this->connection->query($querystring);
        return $statement->fetch();
    }

    public function update($id, $request){
        $this->connection->beginTransaction();
        try{
            $querystring = "UPDATE $this->table SET dr_emp_id = ?, dr_name = ?, dr_office = ?, dr_status = ? WHERE driver_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$request['dr_emp_id'], $request['dr_name'], $request['dr_office'], $request['dr_status'], $id]);
            $this->connection->commit();
            return "Data has been successfully updated!";
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!";
        }
    }

    public function delete($id){
        $this->connection->beginTransaction();
        try{
            $querystring = "DELETE FROM $this->table WHERE driver_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$id]);
            $this->connection->commit();
            return "Data has been successfully deleted!";
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!";
        }
    }
}
?>