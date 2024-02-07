<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <?php$title_page = 'LAKBAY Reservation System';?>
     @include('includes.header')

</head>
<body>
    
<div class="row">
    <div class="col">
        <h4 class="text-uppercase">Events</h4>
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
                    <input type="hidden" name="event_id" value="<?php if(isset($edit_data)) echo $edit_data['event_id']; ?>">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_name" class="form-label mb-0">Event Name</label>
                                <input type="text" class="form-control rounded-1" name="ev_name" placeholder="Enter event name" value="<?php if(isset($edit_data)) echo $edit_data['ev_name']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_venue" class="form-label mb-0">Venue</label>
                                <input type="text" class="form-control rounded-1" name="ev_venue" placeholder="Enter event's venue" value="<?php if(isset($edit_data)) echo $edit_data['ev_venue']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_date_start" class="form-label mb-0">Start Date</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_start" placeholder="Enter event's start date" value="<?php if(isset($edit_data)) echo $edit_data['ev_date_start']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_time_start" class="form-label mb-0">Start time</label>
                                <input type="time" class="form-control rounded-1" name="ev_time_start" placeholder="Enter event's start time" value="<?php if(isset($edit_data)) echo $edit_data['ev_time_start']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_date_end" class="form-label mb-0">End Date</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_end" placeholder="Enter event's end date" value="<?php if(isset($edit_data)) echo $edit_data['ev_date_end']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_time_end" class="form-label mb-0">End Time</label>
                                <input type="time" class="form-control rounded-1" name="ev_time_end" placeholder="Enter event's end time" value="<?php if(isset($edit_data)) echo $edit_data['ev_time_end']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="ev_date_added" class="form-label mb-0">Date Added</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_added" placeholder="Enter date added" value="<?php if(isset($edit_data)) echo $edit_data['ev_date_added']; else date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3 btn-group">
                            <button type="submit" name="submit" value="insert" class="btn btn-outline-primary btn-sm h-50 mt-4 px-4 py-2 w-100 rounded-1">Submit</button>
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
                <?php for($events->page = 1; $events->page <= $events->total_pages ; $events->page++):?>
                <li class="page-item active" aria-current="page">
                    <a href='<?php echo "?page=$events->page"; ?>' class="links">
                        <?php echo $events->page; ?>
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
                    <td>Event Name</td>
                    <td>Venue</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Date Added</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($events->index()) > 0): foreach ($events->index() as $event): ?>
                <tr>
                    <td><?php echo $event->event_id; ?></td>
                    <td><?php echo $event->ev_name; ?></td>
                    <td><?php echo $event->ev_venue; ?></td>
                    <td><?php echo "$event->ev_date_start $event->ev_time_start"; ?></td>
                    <td><?php echo "$event->ev_date_end $event->ev_time_end"; ?></td>
                    <td><?php echo "$event->ev_date_added"; ?></td>
                    <td class="p-1 m-0">
                        <div class="btn-group w-100" role="group">
                            <form action="" method="POST" class="w-50">
                                <button type="submit" name="submit" value="<?php echo $event->event_id ?>" class="btn btn-outline-primary w-100 rounded-0 py-1">Edit</button>
                            </form>
                            <button type="button" class="btn btn-outline-danger py-1" data-bs-toggle="modal" data-bs-target="#deletemodal<?php echo $event->event_id; ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deletemodal<?php echo $event->event_id; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white py-2">
                                            <h6 class="modal-title">Caution!</h6>
                                            <button type="button" class="btn text-white fs-4 py-0" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this record: <b><?php echo $event->ev_venue ?></b>?
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-outline-secondary rounded-0 w-25 btn-sm" data-bs-dismiss="modal">Close</button>
                                            <form action="" method="POST" class="w-25">
                                                <button type="submit" name="delete" value="<?php echo $event->event_id ?>" class="btn btn-outline-danger rounded-0 w-100 btn-sm">Delete</button>
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
@include('includes.footer')

</body>
</html>

