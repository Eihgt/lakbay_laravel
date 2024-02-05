<?php
class Vehicles{
    private $connection;
    private $table = "vehicles";
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
            $querystring .= " WHERE vehicle_id LIKE '%$this->filter%' OR vh_plate_number LIKE '%$this->filter%' OR vh_type LIKE '%$this->filter%' OR vh_brand LIKE '%$this->filter%' OR vh_year LIKE '%$this->filter%' OR vh_fuel_type LIKE '%$this->filter%' OR vh_condition LIKE '%$this->filter%' OR vh_status LIKE '%$this->filter%'";
        }
        $querystring .= " ORDER BY vehicle_id DESC LIMIT $this->starting_limit, $this->page_limit";
        $statement = $this->connection->query($querystring);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function pagination(){
        $querystring = "SELECT count(vehicle_id) FROM $this->table";
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
            if($key != 'submit' && $key != 'vehicle_id'){
                if(empty($value)) return "$key field is required";
                $data[$key] = strip_tags($value);
            } 
        }
        try{
            $querystring = "INSERT INTO $this->table (vh_plate_number, vh_type, vh_brand, vh_year, vh_fuel_type, vh_condition, vh_status) VALUES (:vh_plate_number, :vh_type, :vh_brand, :vh_year, :vh_fuel_type, :vh_condition, :vh_status)";
            $statement= $this->connection->prepare($querystring);
            $statement->execute($data);
            $this->connection->commit();
            return 'Vehicle has successfully created!';
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!".$e;
        }
    }

    public function edit($id){
        $querystring = "SELECT * FROM $this->table WHERE vehicle_id = $id";
        $statement = $this->connection->query($querystring);
        return $statement->fetch();
    }

    public function update($id, $request){
        $this->connection->beginTransaction();
        try{
            $querystring = "UPDATE $this->table SET vh_plate_number = ?, vh_type = ?, vh_brand = ?, vh_year = ?, vh_fuel_type = ?, vh_condition = ?, vh_status = ? WHERE vehicle_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$request['vh_plate_number'], $request['vh_type'], $request['vh_brand'], $request['vh_year'], $request['vh_fuel_type'], $request['vh_condition'], $request['vh_status'], $id]);
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
            $querystring = "DELETE FROM $this->table WHERE vehicle_id = ?";
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