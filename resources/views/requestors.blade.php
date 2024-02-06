<?php
    $title_page = 'LAKBAY Reservation System';
?>
  @include('includes.header');
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">requestors</h4>
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
                        <input type="hidden" name="requestor_id" value="<?php if(isset($edit_data)) echo $edit_data['requestor_id']; ?>">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="rq_full_name" class="form-label mb-0">Full Name</label>
                                    <input type="text" class="form-control rounded-1" name="rq_full_name" placeholder="Enter requestor name" value="<?php if(isset($edit_data)) echo $edit_data['rq_full_name']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="rq_office" class="form-label mb-0">Office</label>
                                    <input type="text" class="form-control rounded-1" name="rq_office" placeholder="Enter requestor's offce" value="<?php if(isset($edit_data)) echo $edit_data['rq_office']; ?>">
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col btn-group">
                                <button type="submit" name="submit" value="insert" class="btn btn-outline-primary h-50 mt-4 px-4 py-1 w-100 rounded-1">Submit</button>
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
                        <td>Full Name</td>
                        <td>Office</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                        <tr>
                            <td colspan="6">No records found</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('includes.footer'); 
