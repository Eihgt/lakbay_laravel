<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <?php $title_page = 'LAKBAY Reservation System';?>
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
        <form action="{{url('/insertEvent')}}" method="POST" class="">
            @csrf
            <div class="card rounded-0">
                <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                    Input/Filter Form
                </div>
                <div class="card-body">
                    <input type="hidden" name="event_id" value="">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_name" class="form-label mb-0">Event Name</label>
                                <input type="text" class="form-control rounded-1" name="ev_name" id="ev_name" placeholder="Enter event name" value="">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_venue" class="form-label mb-0">Venue</label>
                                <input type="text" class="form-control rounded-1" name="ev_venue" id="ev_venue" placeholder="Enter event's venue" value="">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_date_start" class="form-label mb-0">Start Date</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_start" id="ev_date_start" placeholder="Enter event's start date" value="">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_time_start" class="form-label mb-0">Start time</label>
                                <input type="time" class="form-control rounded-1" name="ev_time_start" id="ev_time_start" placeholder="Enter event's start time" value="">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_date_end" class="form-label mb-0">End Date</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_end" id="ev_date_end" placeholder="Enter event's end date" value="">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="ev_time_end" class="form-label mb-0">End Time</label>
                                <input type="time" class="form-control rounded-1" name="ev_time_end" id="ev_time_end" placeholder="Enter event's end time" value="">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="ev_date_added" class="form-label mb-0">Date Added</label>
                                <input type="date" class="form-control rounded-1" name="ev_date_added" id="ev_date_added" placeholder="Enter date added" value="">

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
                
                <li class="page-item active" aria-current="page">
                    <a href='' class="links">
                        
                    </a>
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
        <div class="container">
        <table class="events-table table table-bordered" id="events-table" name="events-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Event Name</td>
                    <td>Venue</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Date Added</td>
                    <td>Date Added</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>


                </tr>
                
                {{-- <trq>
                    <td colspan="6">No records found</td>
                </trq> --}}
                
            </tbody>
        </table>
        </div>

 
    </div>
</div>
@include('includes.footer')

</body>
<script type="text/javascript">
    $(document).ready(function() {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
           var table = $('.events-table').DataTable({

            processing: true
            , serverSide: true
            , ajax: "{{ route('events.show') }}"

            , columns: [{
            data: 'event_id'
            , name: 'event_id'
            }, {
            data: 'ev_name'
            , name: 'ev_name'
            }
            , {
            data: 'ev_venue'
            , name: 'ev_venue'
            } , {
            data: 'ev_date_start'
            , name: 'ev_date_start'
            }
            , {
            data: 'ev_time_start'
            , name: 'ev_time_start'
            }
            , {
            data: 'ev_date_end'
            , name: 'ev_date_end'
            }
            , {
            data: 'ev_date_added'
            , name: 'ev_date_added'
            }

            , {
            data: 'action'
            , name: 'action'
            , orderable: false
            , searchable: false
            }

            , ]
            

            });
        // $('#sample_form').on('submit', function(event) {
        //     event.preventDefault();
        //     var action_url = '';
        //     if ($('#action').val() == 'Edit') {
        //         action_url = "{{ url('/update-office') }}";

        //     }

        //     $.ajax({
        //         type: 'post'
        //         , headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //         , url: action_url
        //         , data: $(this).serialize()
        //         , dataType: 'json'
        //         , success: function(data) {
        //             console.log('success: ' + data);
        //             var html = '';
        //             if (data.errors) {
        //                 html = '<div class="alert alert-danger">';
        //                 for (var count = 0; count < data.errors.length; count++) {
        //                     html += '<p>' + data.errors[count] + '</p>';
        //                 }
        //                 html += '</div>';
        //             }
        //             if (data.success) {
        //                 html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;" + data.success + "</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
        //                 $('#office-table').DataTable().ajax.reload();
        //                 $('#formModal').modal('hide');
        //                 $('#sample_form')[0].reset();

        //             }
        //             $('#form_result').html(html);
        //         }
        //         , error: function(data) {
        //             var errors = data.responseJSON;
        //             console.log(errors);
        //         }
        //     });
        // });
        // //EDIT---------------------------//
        // $(document).on('click', '.edit', function(event) {
        //     event.preventDefault();
        //     var off_id = $(this).attr('id');
        //     //  alert(off_id);
        //     $('#form_result').html('');
        //     $.ajax({
        //         url: "/edit-office/" + off_id + "/"
        //         , headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //         , dataType: "json"
        //         , success: function(data) {
        //             $('#off_acr').val(data.result.off_acr);
        //             $('#off_name').val(data.result.off_name);
        //             $('#off_head').val(data.result.off_head);
        //             $('#hidden_id').val(off_id);
        //             $('.modal-title').text('Edit Record');
        //             $('#action_button').val('Update');
        //             $('#action').val('Edit');
        //             $('#formModal').modal('show');
        //         }
        //         , error: function(data) {
        //             var errors = data.responseJSON;
        //             console.log(errors);
        //         }
        //     })
        // });
        //EDIT---------------------------//
        //DELETE---------------------------//
        // var off_id;
        // $(document).on('click', '.delete', function() {
        //     off_id = $(this).attr('id');

        //     $('#confirmModal').modal('show');
        // });

        // $('#ok_button').click(function() {
        //     $.ajax({
        //         url: "/delete-office/" + off_id
        //         , success: function(data) {
        //             setTimeout(function() {
        //                 $('#confirmModal').modal('hide');
        //                 $('#office-table').DataTable().ajax.reload();
        //             });
        //         }
        //     })
        // });
        //DELETE---------------------------//
    });

</script>

</html>

