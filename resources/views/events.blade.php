<?php
class Events{
    private $connection;
    private $table = "events";
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
            $querystring .= " WHERE event_id LIKE '%$this->filter%' OR ev_name LIKE '%$this->filter%' OR ev_venue LIKE '%$this->filter%' OR ev_date_start LIKE '%$this->filter%' OR ev_time_start LIKE '%$this->filter%' OR ev_date_end LIKE '%$this->filter%' OR ev_time_end LIKE '%$this->filter%' OR ev_date_added LIKE '%$this->filter%'";
        }
        $querystring .= " ORDER BY event_id DESC LIMIT $this->starting_limit, $this->page_limit";
        $statement = $this->connection->query($querystring);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function pagination(){
        $querystring = "SELECT count(event_id) FROM $this->table";
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
            if($key != 'submit' && $key != 'event_id'){
                if(empty($value)) return "$key field is required";
                $data[$key] = strip_tags($value);
            } 
        }
        try{
            $querystring = "INSERT INTO $this->table (ev_name, ev_venue, ev_date_start, ev_time_start, ev_date_end, ev_time_end, ev_date_added) VALUES (:ev_name, :ev_venue, :ev_date_start, :ev_time_start, :ev_date_end, :ev_time_end, :ev_date_added)";
            $statement= $this->connection->prepare($querystring);
            $statement->execute($data);
            $this->connection->commit();
            return 'Event has successfully created!';
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!".$e;
        }
    }

    public function edit($id){
        $querystring = "SELECT * FROM $this->table WHERE event_id = $id";
        $statement = $this->connection->query($querystring);
        return $statement->fetch();
    }

    public function update($id, $request){
        $this->connection->beginTransaction();
        try{
            $querystring = "UPDATE $this->table SET ev_name = ?, ev_venue = ?, ev_date_start = ?, ev_time_start = ?, ev_date_end = ?, ev_time_end = ?, ev_date_added = ? WHERE event_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$request['ev_name'], $request['ev_venue'], $request['ev_date_start'], $request['ev_time_start'], $request['ev_date_end'], $request['ev_time_end'], $request['ev_date_added'], $id]);
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
            $querystring = "DELETE FROM $this->table WHERE event_id = ?";
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