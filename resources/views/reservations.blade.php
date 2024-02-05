<?php
    $title_page = 'LAKBAY Reservation System';
    @include('includes.header');



    // load dropdowns
    // $drivers = $reservations->loaddropdown('drivers', 'driver_id', 'dr_name');
    // $vehicles = $reservations->loaddropdown('vehicles', 'vehicle_id', 'vh_plate_number');
    // $events = $reservations->loaddropdown('events', 'event_id', 'ev_name');
    // $requestors = $reservations->loaddropdown('requestors', 'requestor_id', 'rq_full_name');

    if($_POST){
        if(isset($_POST['submit'])){
            if($_POST['submit'] == 'insert' && $_POST['reservation_id'] == ''){
                $alert = $reservations->create($_POST);
            }elseif($_POST['submit'] == 'insert' && $_POST['reservation_id'] != ''){
                $alert = $reservations->update($_POST['reservation_id'], $_POST);
            }elseif($_POST['submit'] == 'filter'){
                $reservations->setFilter($_POST['keyword']);
                $alert = "Filtered table using keyword: ".$_POST['keyword'];
            }else{
                $edit_data = $reservations->edit($_POST['submit']);
            }
        }elseif(isset($_POST['delete'])){
            $alert = $reservations->delete($_POST['delete']);
        }
        if(isset($alert)){
            echo "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp; $alert</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
        }
    }
?>

<div class="row">
    <div class="col">
        <h4 class="text-uppercase">reservations</h4>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <form action="" method="POST" class="">
            <div class="card rounded-0">
                <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                    Input/Filter Form
                </div>
                <div class="card-body">
                    <input type="hidden" name="reservation_id" value="<?php if(isset($edit_data)) echo $edit_data['reservation_id']; ?>">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="event_id" class="form-label mb-0">Event Name</label>
                                <select class="form-select" name="event_id">
                                    <option value="">Select an event</option>
                                    <?php foreach($events as $event){ ?>
                                    <option value="<?php echo $event->event_id; ?>" <?php if(isset($edit_data) && $edit_data['ev_name'] == $event->ev_name) echo 'selected'; ?>><?php echo $event->ev_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="driver_id" class="form-label mb-0">Driver</label>
                                <select class="form-select" name="driver_id">
                                    <option value="">Select driver</option>
                                    <?php foreach($drivers as $driver): ?>
                                    <option value="<?php echo $driver->driver_id; ?>" <?php if(isset($edit_data) && $edit_data['dr_name'] == $driver->dr_name) echo 'selected'; ?>><?php echo $driver->dr_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="vehicle_id" class="form-label mb-0">Vehicle</label>
                                <select class="form-select" name="vehicle_id">
                                    <option value="">Select vehicle</option>
                                    <?php foreach($vehicles as $vehicle): ?>
                                    <option value="<?php echo $vehicle->vehicle_id; ?>" <?php if(isset($edit_data) && $edit_data['vh_plate_number'] == $vehicle->vh_plate_number) echo 'selected'; ?>><?php echo $vehicle->vh_plate_number; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="requestor_id" class="form-label mb-0">Requestor</label>
                                <select class="form-select" name="requestor_id">
                                    <option value="">Select requestor</option>
                                    <?php foreach($requestors as $requestor): ?>
                                    <option value="<?php echo $requestor->requestor_id; ?>" <?php if(isset($edit_data) && $edit_data['rq_full_name'] == $requestor->rq_full_name) echo 'selected'; ?>><?php echo $requestor->rq_full_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="rs_voucher" class="form-label mb-0">Voucher</label>
                                <input type="text" class="form-control rounded-1" name="rs_voucher" placeholder="Enter reservation name" value="<?php if(isset($edit_data)) echo $edit_data['rs_voucher']; ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2 pt-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="rs_daily_transport" type="checkbox" value="1" <?php if(isset($edit_data) && $edit_data['rs_daily_transport']) echo 'checked'; ?>>
                                    <label class="form-check-label" for="rs_daily_transport">
                                        Daily Transport?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2 pt-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="rs_outside_province" type="checkbox" value="1" <?php if(isset($edit_data) && $edit_data['rs_outside_province']) echo 'checked'; ?>>
                                    <label class="form-check-label" for="rs_outside_province">
                                        Travel Outside Privince?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="rs_date_filed" class="form-label mb-0">Date of Filing</label>
                                <input type="date" class="form-control rounded-1" name="rs_date_filed" placeholder="Enter reservation's start time" value="<?php if(isset($edit_data)) echo $edit_data['rs_date_filed']; ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <label for="rs_approval_status" class="form-label mb-0">Approval Status</label>
                                <select class="form-select" name="rs_approval_status">
                                    <option value="">Select Approval Status</option>
                                    <option value="approved" <?php if(isset($edit_data) && $edit_data['rs_approval_status'] == 'approved') echo 'selected'; ?>>Approved</option>
                                    <option value="rejected" <?php if(isset($edit_data) && $edit_data['rs_approval_status'] == 'rejected') echo 'selected'; ?>>Rejected</option>
                                    <option value="pending" <?php if(isset($edit_data) && $edit_data['rs_approval_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <label for="rs_status" class="form-label mb-0">Reservation Status</label>
                                <select class="form-select" name="rs_status">
                                    <option value="">Select Status</option>
                                    <option value="on-going" <?php if(isset($edit_data) && $edit_data['rs_status'] == 'on-going') echo 'selected'; ?>>On-going</option>
                                    <option value="queued" <?php if(isset($edit_data) && $edit_data['rs_status'] == 'queued') echo 'selected'; ?>>Queued</option>
                                    <option value="done" <?php if(isset($edit_data) && $edit_data['rs_status'] == 'done') echo 'selected'; ?>>Done</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end align-items-center">
                        <div class="col-4 btn-group">
                            <button type="submit" name="submit" value="insert" class="btn btn-outline-primary px-4 py-1 w-100 rounded-1">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-7">
        <nav aria-label="...">
            <ul class="pagination rounded-1">
                <li class="page-item disabled">
                    <a class="page-link rounded-0" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php for($reservations->page = 1; $reservations->page <= $reservations->total_pages ; $reservations->page++):?>
                <li class="page-item active" aria-current="page">
                    <a href='<?php echo "?page=$reservations->page"; ?>' class="links">
                        <?php echo $reservations->page; ?>
                    </a>
                </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link rounded-0" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-5">
        <div class="row">
            <form action="" method="POST" class="w-100">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text rounded-0" id="addon-wrapping">Filter</span>
                    <input type="text" name="keyword" class="form-control rounded-0" placeholder="Enter Keyword" aria-label="Username" aria-describedby="addon-wrapping">
                    <button class="btn btn-outline-secondary rounded-0 px-4" type="submit" name="submit" value="filter">Go</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Event</td>
                    <td>Driver</td>
                    <td>Vehicle</td>
                    <td>Requestor</td>
                    <td>Voucher</td>
                    <td>DT</td>
                    <td>OP</td>
                    <td>Filing</td>
                    <td>Approval</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($reservations->index()) > 0): foreach ($reservations->index() as $reservation): ?>
                <tr>
                    <td><?php echo $reservation->reservation_id; ?></td>
                    <td><?php echo $reservation->ev_name; ?></td>
                    <td><?php echo $reservation->dr_name; ?></td>
                    <td><?php echo $reservation->vh_plate_number; ?></td>
                    <td><?php echo $reservation->rq_full_name; ?></td>
                    <td><?php echo $reservation->rs_voucher; ?></td>
                    <td><?php echo $reservation->rs_daily_transport; ?></td>
                    <td><?php echo $reservation->rs_outside_province; ?></td>
                    <td><?php echo $reservation->rs_date_filed; ?></td>
                    <td><?php echo $reservation->rs_approval_status; ?></td>
                    <td><?php echo $reservation->rs_status; ?></td>
                    <td class="p-1 m-0">
                        <div class="btn-group w-100" role="group">
                            <form action="" method="POST" class="w-50">
                                <button type="submit" name="submit" value="<?php echo $reservation->reservation_id ?>" class="btn btn-outline-primary w-100 rounded-0 py-1">Edit</button>
                            </form>
                            <button type="button" class="btn btn-outline-danger py-1" data-bs-toggle="modal" data-bs-target="#deletemodal<?php echo $reservation->reservation_id; ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletemodal<?php echo $reservation->reservation_id; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white py-2">
                                            <h6 class="modal-title">Caution!</h6>
                                            <button type="button" class="btn text-white fs-4 py-0" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete reservation for <b><?php echo $reservation->rq_full_name ?></b>?
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-outline-secondary rounded-0 w-25 btn-sm" data-bs-dismiss="modal">Close</button>
                                            <form action="" method="POST" class="w-25">
                                                <button type="submit" name="delete" value="<?php echo $reservation->reservation_id ?>" class="btn btn-outline-danger rounded-0 w-100 btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6">No records found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    include_once "includes/footer.php"
?>
