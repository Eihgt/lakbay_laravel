<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    $title_page = 'LAKBAY Reservation System';
?>
 @include('includes.header')
</head>
<body>
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">reservations</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <form action="" method="POST" class="reservations-form" id="reservations-form" name="reservations-form">
                @csrf
                <div class="card rounded-0">
                    <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                        Input/Filter Form
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="reservation_id" value="">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="event_id" class="form-label mb-0">Event Name</label>
                                    <select class="form-select" name="event_id">
                                        <option value="">Select Event Name</option>
                                        @foreach ($events as $event)
                                        <option value="{{$event->event_id}}">{{ $event->ev_name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="driver_id" class="form-label mb-0">Driver</label>
                                    <select class="form-select" name="driver_id">
                                        <option value="">Select driver</option>
                                        @foreach ($drivers as $driver)
                                        <option value="{{$driver->driver_id}}">{{ $driver->dr_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vehicle_id" class="form-label mb-0">Vehicle</label>
                                    <select class="form-select" name="vehicle_id">
                                        <option value="">Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vh_brand }}-{{ $vehicle->vh_plate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="requestor_id" class="form-label mb-0">Requestor</label>
                                    <select class="form-select" name="requestor_id" id="requestor_id">
                                        <option value="">Select Requestor</option>
                                        @foreach ($requestors as $requestor)
                                        <option value="{{ $requestor->requestor_id }}">{{ $requestor->rq_full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="rs_voucher" class="form-label mb-0">Voucher</label>
                                    <input type="text" class="form-control rounded-1" name="rs_voucher" placeholder="Enter Voucher code" value="">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2 pt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rs_daily_transport" type="checkbox" value="1">
                                        <label class="form-check-label" for="rs_daily_transport">
                                            Daily Transport?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2 pt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rs_outside_province" type="checkbox" value="1">
                                        <label class="form-check-label" for="rs_outside_province">
                                            Travel Outside Privince?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                {{-- <div class="col-6">
                                    <div class="mb-2">
                                        <label for="rs_date_filed" class="form-label mb-0">Date of Filing</label>
                                        <input type="date" class="form-control rounded-1" name="rs_date_filed" placeholder="Enter reservation's start time" value="">
                                    </div>
                                </div> --}}
                            <div class="col-3">
                                <div class="mb-2">
                                    <label for="rs_approval_status" class="form-label mb-0">Approval Status</label>
                                    <select class="form-select" name="rs_approval_status">
                                        <option value="">Select Approval Status</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <label for="rs_status" class="form-label mb-0">Reservation Status</label>
                                    <select class="form-select" name="rs_status">
                                        <option value="">Select Status</option>
                                        <option value="on-going" >On-going</option>
                                        <option value="queued">Queued</option>
                                        <option value="done">Done</option>
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
    </div>
    <span id="form_result"></span>
    <div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover reservations-table" id="reservations-table" name="reservations-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Event</td>
                        <td>Driver</td>
                        <td>Vehicle</td>
                        <td>Requestor</td>
                        <td>Voucher</td>
                        <td>Travel Type</td>
                        <td>Date Filed</td>
                        <td>Approval</td>
                        <td>Status</td>
                        <td width="100px">Actions</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('.reservations-table').DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    search: {
        return: true
    },
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    buttons: [
        // {
        //         text: 'Word',
        //         action: function ( e, dt, node, config ) {
        //             window.location.href='/driver-word';
        //         }
        // },
        // {
        //         text: 'Excel',
        //         action: function ( e, dt, node, config ) {
        //             window.location.href='/driver-excel';
        //         }
        // }
    //     {
    //         extend: 'excel',
    //         exportOptions: {
    //             columns: ':visible'
    //         }
    //     },
    //     {
    //         extend: 'print',
    //         exportOptions: {
    //             columns: ':visible'
    //         }
    //     },
    //     {
    //         extend: 'pdf',
    //         exportOptions: {
    //             columns: ':visible'
    //         }
    //     },
    //     {
    //         extend: 'copy',
    //         exportOptions: {
    //             columns: ':visible'
    //         }
    //     },
    //     {
    //         extend: 'csv',
    //         exportOptions: {
    //             columns: ':visible'
    //         }
    //     },
    //     'colvis'
    // ],
    // columnDefs: [
    //     {
    //         targets: 0,
    //         visible: true
    //     }
    ],
    ajax: "{{ route('reservations.show') }}",
    columns: [
    {data: 'reservation_id', name: 'reservation_id'},
    {data: 'ev_name', name: 'events.ev_name'},
    {data: 'dr_name', name: 'drivers.dr_name'},
    {data: 'vh_brand', name: 'vehicles.vh_brand'},
    {data: 'rq_full_name', name: 'requestors.rq_full_name'},
    {data: 'rs_voucher', name: 'rs_voucher'},
    {data: 'rs_daily_transport', name: 'rs_daily_transport'},
    {data: 'created_at', name: 'created_at'},
    {data: 'rs_approval_status', name: 'rs_approval_status'},
    {data: 'rs_status', name: 'rs_status'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]

});

 // STORE---------------------------//
        $('#reservations-form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{url('/insert-reservations')}}";
            $.ajax({
                type: 'post'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: action_url
                , data: $(this).serialize()
                , dataType: 'json'
                , success: function(data) {
                    console.log('success: ' + data);
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;" + data.success + "</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
                        $('#reservations-table').DataTable().ajax.reload();
                        $('#reservations-form')[0].reset();

                    }
                    $('#form_result').html(html);
                }
                , error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
 // STORE---------------------------//
  // EDIT---------------------------//
  $(document).on('click', '.edit', function(event){
             event.preventDefault();
             var driver_id= $(this).attr('id');
            //  alert(driver_id);
             $('#form_result').html('');
             $.ajax({
             url :"/edit-driver/"+driver_id+"/",
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             dataType:"json",
             success:function(data)
             {
             $('#dr_emp_id_modal').val(data.result.dr_emp_id);
             $('#dr_name_modal').val(data.result.dr_name);
             $('#dr_office_modal').val(data.result.off_name);
             $('#dr_status_modal').val(data.result.dr_status);
             $('#hidden_id').val(driver_id);
             $('.modal-title').text('Edit Record');
             $('#action_button').val('Update');
             $('#action').val('Edit');
             $('#formModal').modal('show');
             
             },
             error: function(data) {
             var errors = data.responseJSON;
             console.log(errors);
             }
             })
             });
         // EDIT---------------------------//
        //UPDATE------------------------------------------//
        $('#driver_modal').on('submit', function(event) {
                    event.preventDefault();
                    var action_url = "{{ url('/update-driver')}}";

                    $.ajax({
                        type: 'post'
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: action_url
                        , data: $(this).serialize()
                        , dataType: 'json'
                        , success: function(data) {
                            console.log('success: ' + data);
                            var html = '';
                            if (data.errors) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;" + data.success + "</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
                                $('#driver-table').DataTable().ajax.reload();
                                $('#formModal').modal('hide');
                                $('#driver_modal')[0].reset();
                                

                            }
                            $('#form_result').html(html);
                        }
                        , error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
        //UPDATE------------------------------------------//
        // DELETE---------------------------//
        var driver_id;
        $(document).on('click', '.delete', function() {
            driver_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: "/delete-driver/" + driver_id
                , success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#driver-table').DataTable().ajax.reload();
                    });
                }
            })
        });
        //DELETE---------------------------//
});
    

</script>
@include('includes.footer');
</html>





