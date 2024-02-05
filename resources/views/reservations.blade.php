<?php
class Reservations{
    private $connection;
    private $table = "reservations";
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

        $querystring = "SELECT * FROM $this->table ";
        $querystring .= "INNER JOIN events ON reservations.event_id = events.event_id ";
        $querystring .= "INNER JOIN vehicles ON reservations.vehicle_id = vehicles.vehicle_id ";
        $querystring .= "INNER JOIN drivers ON reservations.driver_id = drivers.driver_id ";
        $querystring .= "INNER JOIN requestors ON reservations.requestor_id = requestors.requestor_id ";
        if(!empty($this->filter)){
            $querystring .= " WHERE reservation_id LIKE '%$this->filter%' OR rs_voucher LIKE '%$this->filter%' OR rs_daily_transport LIKE '%$this->filter%' OR rs_outside_province LIKE '%$this->filter%' OR rs_date_filed LIKE '%$this->filter%' OR rs_approval_status LIKE '%$this->filter%' OR rs_status LIKE '%$this->filter%' OR ev_name LIKE '%$this->filter%' OR dr_name LIKE '%$this->filter%' OR vh_plate_number LIKE '%$this->filter%' OR rq_full_name LIKE '%$this->filter%'";
        }
        $querystring .= " ORDER BY reservation_id DESC LIMIT $this->starting_limit, $this->page_limit";
        $statement = $this->connection->query($querystring);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function pagination(){
        $querystring = "SELECT count(reservation_id) FROM $this->table";
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
            if($key != 'submit' && $key != 'reservation_id'){
                if(empty($value) && $key != 'rs_daily_transport' && $key != 'rs_outside_province') return "$key field is required";
                $data[$key] = strip_tags($value);
            } 
        }
        try{
            $querystring = "INSERT INTO $this->table (rs_voucher, rs_daily_transport, rs_outside_province, rs_date_filed, rs_approval_status, rs_status, event_id, driver_id, vehicle_id, requestor_id) VALUES (:rs_voucher, :rs_daily_transport, :rs_outside_province, :rs_date_filed, :rs_approval_status, :rs_status, :event_id, :driver_id, :vehicle_id, :requestor_id)";
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
        $querystring = "SELECT * FROM $this->table ";
        $querystring .= "INNER JOIN events ON reservations.event_id = events.event_id ";
        $querystring .= "INNER JOIN vehicles ON reservations.vehicle_id = vehicles.vehicle_id ";
        $querystring .= "INNER JOIN drivers ON reservations.driver_id = drivers.driver_id ";
        $querystring .= "INNER JOIN requestors ON reservations.requestor_id = requestors.requestor_id ";
        $querystring .= " WHERE reservation_id = $id";
        $statement = $this->connection->query($querystring);
        return $statement->fetch();
    }

    public function update($id, $request){
        $this->connection->beginTransaction();
        try{
            $querystring = "UPDATE $this->table SET rs_voucher = ?, rs_daily_transport = ?, rs_outside_province = ?, rs_date_filed = ?, rs_approval_status = ?, rs_status = ?, event_id = ?, driver_id = ?, vehicle_id = ?, requestor_id = ? WHERE reservation_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$request['rs_voucher'], $request['rs_daily_transport'], $request['rs_outside_province'], $request['rs_date_filed'], $request['rs_approval_status'], $request['rs_status'], $request['event_id'], $request['driver_id'], $request['vehicle_id'], $request['requestor_id'], $id]);
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
            $querystring = "DELETE FROM $this->table WHERE reservation_id = ?";
            $statement= $this->connection->prepare($querystring);
            $statement->execute([$id]);
            $this->connection->commit();
            return "Data has been successfully deleted!";
        }catch(Exception $e){
            $this->connection->rollBack();
            return "Something went wrong with your query!";
        }
    }

    public function loaddropdown($table, $id_field, $field){
        $querystring = "SELECT `$id_field`, `$field` FROM $table";
        $statement = $this->connection->query($querystring);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}
?>