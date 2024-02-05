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
{{-- <div class="row">
    <div class="col-7">
        <nav aria-label="...">
            <ul class="pagination rounded-1">
                <li class="page-item disabled">
                    <a class="page-link rounded-0" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php for($drivers->page = 1; $drivers->page <= $drivers->total_pages ; $drivers->page++):?>
                <li class="page-item active" aria-current="page">
                    <a href='<?php echo "?page=$drivers->page"; ?>' class="links">
                        <?php echo $drivers->page; ?>
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
</div> --}}
{{-- <div class="row">
    <div class="col">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Employee ID</td>
                    <td>Full Name</td>
                    <td>Office</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($drivers->index()) > 0): foreach ($drivers->index() as $driver): ?>
                <tr>
                    <td><?php echo $driver->driver_id; ?></td>
                    <td><?php echo $driver->dr_emp_id; ?></td>
                    <td><?php echo $driver->dr_name; ?></td>
                    <td><?php echo $driver->dr_office; ?></td>
                    <td><?php echo $driver->dr_status; ?></td>
                    <td class="p-1 m-0">
                        <div class="btn-group w-100" role="group">
                            <form action="" method="POST" class="w-50">
                                <button type="submit" name="submit" value="<?php echo $driver->driver_id ?>" class="btn btn-outline-primary w-100 rounded-0 py-1">Edit</button>
                            </form>
                            <button type="button" class="btn btn-outline-danger py-1" data-bs-toggle="modal" data-bs-target="#deletemodal<?php echo $driver->driver_id; ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletemodal<?php echo $driver->driver_id; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white py-2">
                                            <h6 class="modal-title">Caution!</h6>
                                            <button type="button" class="btn text-white fs-4 py-0" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <b><?php echo $driver->dr_name ?></b>'s record?
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-outline-secondary rounded-0 w-25 btn-sm" data-bs-dismiss="modal">Close</button>
                                            <form action="" method="POST" class="w-25">
                                                <button type="submit" name="delete" value="<?php echo $driver->driver_id ?>" class="btn btn-outline-danger rounded-0 w-100 btn-sm">Delete</button>
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
</div> --}}
@include('includes.footer')
