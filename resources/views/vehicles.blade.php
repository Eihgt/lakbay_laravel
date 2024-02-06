<?php
    $title_page = 'LAKBAY Reservation System';   
?>
@include('includes.header');

    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">Vehicles</h4>
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
                        <input type="hidden" name="vehicle_id" value="<?php if(isset($edit_data)) echo $edit_data['vehicle_id']; ?>">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_plate_number" class="form-label mb-0">Plate Number</label>
                                    <input type="text" class="form-control rounded-1" name="vh_plate_number" placeholder="Enter vehicle name" value="<?php if(isset($edit_data)) echo $edit_data['vh_plate_number']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_type" class="form-label mb-0">Type</label>
                                    <input type="text" class="form-control rounded-1" name="vh_type" placeholder="Enter vehicle's venue" value="<?php if(isset($edit_data)) echo $edit_data['vh_type']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_brand" class="form-label mb-0">Brand</label>
                                    <input type="text" class="form-control rounded-1" name="vh_brand" placeholder="Enter vehicle's start date" value="<?php if(isset($edit_data)) echo $edit_data['vh_brand']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_year" class="form-label mb-0">Year</label>
                                    <input type="number" class="form-control rounded-1" name="vh_year" placeholder="Enter vehicle's start time" value="<?php if(isset($edit_data)) echo $edit_data['vh_year']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_fuel_type" class="form-label mb-0">Fuel Type</label>
                                    <input type="text" class="form-control rounded-1" name="vh_fuel_type" placeholder="Enter vehicle's end date" value="<?php if(isset($edit_data)) echo $edit_data['vh_fuel_type']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_condition" class="form-label mb-0">Condition</label>
                                    <input type="text" class="form-control rounded-1" name="vh_condition" placeholder="Enter vehicle's end time" value="<?php if(isset($edit_data)) echo $edit_data['vh_condition']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_status" class="form-label mb-0">Status</label>
                                    <input type="text" class="form-control rounded-1" name="vh_status" placeholder="Enter date added" value="<?php if(isset($edit_data)) echo $edit_data['vh_status']; ?>">
                                </div>
                            </div>
                            <div class="col btn-group">
                                <button type="submit" name="submit" value="insert" class="btn btn-outline-primary btn-sm h-50 mt-4 px-4 py-2 w-100 rounded-1">Submit</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <nav aria-label="...">
                
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
                        <td>Plate Number</td>
                        <td>Type</td>
                        <td>Brand</td>
                        <td>Year</td>
                        <td>Fuel Type</td>
                        <td>Condition</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@include('includes.footer');
