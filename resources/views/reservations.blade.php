<?php
    $title_page = 'LAKBAY Reservation System';
?>
 @include('includes.header');

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
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="driver_id" class="form-label mb-0">Driver</label>
                                <select class="form-select" name="driver_id">
                                    <option value="">Select driver</option>
                                 
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
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="requestor_id" class="form-label mb-0">Requestor</label>
                                <select class="form-select" name="requestor_id">
                                    <option value="">Select requestor</option>
                                  
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
               
            </tbody>
        </table>
    </div>
</div>
@include('includes.footer');

