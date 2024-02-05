<?php
    $title_page = 'LAKBAY Reservation System';
    @include('includes.header')
    // if($_POST){
    //     if(isset($_POST['submit'])){
    //         if($_POST['submit'] == 'insert' && $_POST['driver_id'] == ''){
    //             $alert = $drivers->create($_POST);
    //         }elseif($_POST['submit'] == 'insert' && $_POST['driver_id'] != ''){
    //             $alert = $drivers->update($_POST['driver_id'], $_POST);
    //         }elseif($_POST['submit'] == 'filter'){
    //             $drivers->setFilter($_POST['keyword']);
    //             $alert = "Filtered table using keyword: ".$_POST['keyword'];
    //         }else{
    //             $edit_data = $drivers->edit($_POST['submit']);
    //         }
    //     }elseif(isset($_POST['delete'])){
    //         $alert = $drivers->delete($_POST['delete']);
    //     }
    //     if(isset($alert)){
    //         echo "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp; $alert</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
    //     }
    // }
?>

<div class="row">
    <div class="col">
        <h4 class="text-uppercase">Drivers</h4>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <form action="{{url('/insertDriver')}}" method="POST" class="">
            @csrf
            <div class="card rounded-0">
                <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                    Input/Filter Form
                </div>
                <div class="card-body">
                    <input type="hidden" name="driver_id" value="<?php if(isset($edit_data)) echo $edit_data['driver_id']; ?>">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="dr_emp_id" class="form-label mb-0">Employee ID</label>
                                <input type="text" class="form-control rounded-1" name="dr_emp_id" placeholder="Enter employee ID" value="<?php if(isset($edit_data)) echo $edit_data['dr_emp_id']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="dr_name" class="form-label mb-0">Full Name</label>
                                <input type="text" class="form-control rounded-1" name="dr_name" placeholder="Enter driver's full name" value="<?php if(isset($edit_data)) echo $edit_data['dr_name']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="dr_office" class="form-label mb-0">Office</label>
                                <input type="text" class="form-control rounded-1" name="dr_office" placeholder="Enter driver's office" value="<?php if(isset($edit_data)) echo $edit_data['dr_office']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="dr_status" class="form-label mb-0">Status</label>
                                <input type="text" class="form-control rounded-1" name="dr_status" placeholder="Enter driver's status" value="<?php if(isset($edit_data)) echo $edit_data['dr_status']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end align-items-center">
                        <div class="col-3 btn-group">
                            <button type="submit" name="submit" value="insert" class="btn btn-outline-primary px-4 py-1 w-100 rounded-1">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('includes.footer')
