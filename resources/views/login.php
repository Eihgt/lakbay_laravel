<?php
    $title_page = 'LAKBAY Reservation System';
    include_once "includes/header.php";
    include_once "config/database.php";
    include_once "classes/authentication.php";

    $database = new Database();
    $connection = $database->getConnection();

    $authentication = new Authentication($connection);
    if(isset($_POST["submit"])){
        $alert = $authentication->login($_POST);
        if(isset($alert)){
            echo "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp; $alert</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
        }
    }
?>
    <div class="row">
        <div class="col">
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                <p>Enter Credentials</p>
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <label for="username" class="form-label mb-0">Username</label>
                            <input type="text" class="form-control rounded-1" name="username" placeholder="Enter event name" value="<?php if(isset($edit_data)) echo $edit_data['ev_name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <label for="password" class="form-label mb-0">Password</label>
                            <input type="password" class="form-control rounded-1" name="password" placeholder="Enter event's venue" value="<?php if(isset($edit_data)) echo $edit_data['ev_venue']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-end align-items-center">
                    <div class="col-3 btn-group">
                        <button type="submit" name="submit" value="submit" class="btn btn-outline-primary px-4 py-1 w-100 rounded-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    include_once "includes/footer.php"
?>