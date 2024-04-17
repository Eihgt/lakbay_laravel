<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservations</title>
    <?php $title_page = 'Reservations';?>
 @include('includes.header')
</head>
<body>
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">Reservations</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="#insertModal" role="button" class="btn btn-lg btn-success" id="insertBtn" data-bs-toggle="modal">Reserve</a>
            <div id="insertModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reservation Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" class="reservations-form" id="reservations-form" name="reservations-form">
                                @csrf
                                <div class="card rounded-0">
                                    <div class="card-body">
                                        <input type="hidden" name="reservation_id" value="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <label for="event_id" class="form-label mb-0">Event Name</label>
                                                    <select class="form-select" name="event_id" id="event_id">
                                                        <option value=""disabled selected>Select Event Name</option>
                                                        @foreach ($events as $event)
                                                        <option value="{{$event->event_id}}">{{ $event->ev_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="event_id_error"></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-2">
                                                    <label for="driver_id" class="form-label mb-0">Driver</label>
                                                    <select class="form-select drivers-select" name="driver_id[]" id="driver_id" multiple>
                                                        <option value="" disabled selected>Select driver</option>
                                                        @foreach ($drivers as $driver)
                                                        <option value="{{$driver->driver_id}}">{{ $driver->dr_fname }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="driver_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <label for="vehicle_id" class="form-label mb-0">Vehicle</label>
                                                    <select class="form-select vehicles-select" name="vehicle_id[]" id="vehicle_id" multiple>
                                                        <option value=""disabled selected>Select Vehicle</option>
                                                        @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vh_brand }}-{{ $vehicle->vh_plate }}-{{$vehicle->vh_capacity}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="vehicle_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <label for="requestor_id" class="form-label mb-0">Requestor</label>
                                                    <select class="form-select" name="requestor_id" id="requestor_id">
                                                        <option value=""disabled selected>Select Requestor</option>
                                                        @foreach ($requestors as $requestor)
                                                        <option value="{{ $requestor->requestor_id }}">{{ $requestor->rq_full_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="requestor_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-2">
                                                    <label for="rs_voucher" class="form-label mb-0">Voucher</label>
                                                    <input type="text" class="form-control rounded-1" name="rs_voucher" placeholder="Enter Voucher code" id="rs_voucher" value="">
                                                    <span id="rs_voucher_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-2">
                                                    <label for="rs_passengers" class="form-label mb-0">Passengers</label>
                                                    <input type="text" class="form-control rounded-1" name="rs_passengers" placeholder="Enter Number of Passengers" id="rs_passengers" value="">
                                                    <span id="rs_passengers_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-4"> 
                                                <div class="mb-2">
                                                    <label for="rs_travel_type" class="form-label mb-0">Travel Type</label>
                                                    <select class="form-select" name="rs_travel_type" id="rs_travel_type">
                                                        <option value=""disabled selected>Select Travel Type</option>
                                                        <option value="Outside Province Transport">Outside Province Transport</option>       
                                                        <option value="Daily Transport">Daily Transport</option>
                                                    </select>
                                                    <span id="rs_travel_type_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-2">
                                                    <label for="rs_approval_status" class="form-label mb-0">Approval Status</label>
                                                    <select class="form-select" name="rs_approval_status" id="rs_approval_status">
                                                        <option value=""disabled selected>Select Approval Status</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Rejected">Rejected</option>
                                                        <option value="Pending">Pending</option>
                                                    </select>
                                                    <span id="rs_approval_status_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-2">
                                                    <label for="rs_status" class="form-label mb-0">Reservation Status</label>
                                                    <select class="form-select" name="rs_status" id="rs_status">
                                                        <option value=""disabled selected>Select Status</option>
                                                        <option value="On-going" >On-going</option>
                                                        <option value="Queued">Queued</option>
                                                        <option value="Done">Done</option>
                                                    </select>
                                                    <span id="rs_status_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="submit" value="insert" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <td>Vehicle</td>
                        <td>Driver</td>
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
<!-------------EDIT MODAL --------------->
<div class="modal fade" tabindex="-1" id="reservation_modal" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="reservation_edit" name="reservation_edit" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Event : </label>
                        <select class="form-select" name="event_edit" id="event_edit">
                            @foreach ($events as $event)
                            <option value="{{$event->event_id}}">{{ $event->ev_name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Driver : </label>
                        <select class="form-select driver_edit" name="driver_edit[]" id="driver_edit" multiple>
                            @foreach ($drivers as $driver)
                            <option value="{{$driver->driver_id}}">{{ $driver->dr_fname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Vehicle</label>
                        <select class="form-select vehicle_edit" name="vehicle_edit[]" id="vehicle_edit" multiple>
                            @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vh_brand }}-{{ $vehicle->vh_plate }}-{{$vehicle->vh_capacity}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Requestor</label>
                        <select class="form-select" name="requestor_edit" id="requestor_edit" id="requestor_edit">
                            @foreach ($requestors as $requestor)
                            <option value="{{ $requestor->requestor_id }}" id="requestor_value">{{ $requestor->rq_full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">   
                            <label for="voucher_edit" class="form-label mb-0">Voucher</label>
                            <input type="text" class="form-control rounded-1" name="voucher_edit" id="voucher_edit" value="">                     
                    </div>
                    <div class="form-group">
                        <label>Travel Type : </label>
                        <select class="form-select" name="travel_edit" id="travel_edit">
                            <option value="Outside Province Transport">Outside Province Transport</option>       
                            <option value="Daily Transport">Daily Transport</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="approval_status_edit">Approval Status</label>
                        <select name="approval_status_edit" id="approval_status_edit">
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="status_edit">Status</label>
                        <select name="status_edit" id="status_edit">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Cancelled">Cancelled</option>
                          </select>
                    </div>
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" value="Update" class="btn btn-info"/>
                </div>
            </form>
        </div>
    </div>
</div> 
<!-------------DELETE MODAL --------------->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="events_form" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="confirm_message" align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" action="" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.vehicles-select').select2();
        $('.drivers-select').select2();
        $('.vehicle_edit').select2();
        $("#insertModal").modal("hide");
        $("#insertBtn").click(function() {
        $("#insertModal").modal("show");
    });

    var table = $('.reservations-table').DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    search: {
        return: true
    },
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    buttons: [
        {
            text: 'Word',
            action: function ( e, dt, node, config ) {
                var searchValue = $('.dataTables_filter input').val();
                window.location.href='/reservations-word?search=' + searchValue;
            }
        },
        {
            text: 'Excel',
            action: function ( e, dt, node, config ) {
                var searchValue = $('.dataTables_filter input').val();
                window.location.href = '/reservations-excel?search=' + searchValue;
            }
        },
        {
            text: 'Pdf',
            action: function ( e, dt, node, config ) {
                var searchValue = $('.dataTables_filter input').val();
                window.location.href = '/reservations-pdf?search=' + searchValue;
            }
        },
        {
            text: 'Archive',
            action: function ( e, dt, node, config ) {
                var searchValue = $('.dataTables_filter input').val();
                window.location.href='/reservations-archive';
            }
        }
    ],
    ajax: "{{ route('reservations.show') }}",
    columns: [
        {data: 'reservation_id', name: 'reservation_id'},
        {data: 'ev_name', name: 'events.ev_name'},
        {data: 'reservation_vehicles',
        render: function(data,type,row,meta){
            var vehicles=[];

            data.forEach((item, index)=>{
            vehicles.push(item.vehicles.vh_brand)          
            })
            return vehicles.join(",").toString();
        }
    },
    {data: 'reservation_vehicles',
        render: function(data,type,row,meta){
            var drivers=[];
            data.forEach((item, index)=>{
            if(item.drivers !=null){
                drivers.push(item.drivers.dr_fname) 
            }
                     
            })
            return drivers.join(",").toString();
        }
    },
           
        {data: 'rq_full_name', name: 'requestors.rq_full_name'},
        {data: 'rs_voucher', name: 'rs_voucher'},
        {data: 'rs_travel_type', name: 'rs_travel_type'},
        {data: 'created_at', name: 'created_at'},
        {data: 'rs_approval_status', name: 'rs_approval_status'},
        {data: 'rs_status', name: 'rs_status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});



 // STORE---------------------------//
        $('#reservations-form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{url('/insert-reservation')}}";
            $.ajax({
                type: 'post'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: action_url
                , data: $(this).serialize()
                , dataType: 'json'
                , success: function(data) {
                    console.log('custom: ' + data);
                    var html = '';
                    if (data.success) {
                        html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;" + data.success + "</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
                        $('#reservations-table').DataTable().ajax.reload();
                        $('#reservations-form')[0].reset();
                        $("#insertModal").modal("hide");
                    }
                    $('#form_result').html(html);
                }
                , error: function(data) {
                var errors = data.responseJSON.errors;
                var html = '<span class="text-danger">';
                $.each(errors, function(key, value) {
                    // console.log(key);
                    $('#' + key + '_error').html(html + value + '</span>');
                    $('#' + key).on('input', function() {
                        if ($(this).val().trim() !== '') {
                            $('#' + key + '_error').empty();
                        }
                    });
                });
            }


            });
        });
 // STORE---------------------------//
  // EDIT---------------------------//
  $(document).on('click', '.edit', function(event){
            
             event.preventDefault();
             var reservation_id= $(this).attr('id');
             var row = table.row($(this).parents('tr')).data();
             var vehicles = row.reservation_vehicles;
             var vehicle_ids=[];
             var driver_ids=[];
            vehicles.forEach((item, index)=>{
                vehicle_ids.push(item.vehicle_id);  
                driver_ids.push(item.driver_id);  
            });
             $('#form_result').html('');
            $('#event_edit').val(row.event_id);
            $('#vehicle_edit').select2().val(vehicle_ids).change();
            $('#driver_edit').select2().val(driver_ids).change();
            $('#requestor_edit').val(row.requestor_id);
            $('#voucher_edit').val(row.rs_voucher);
            $('#approval_status_edit').val(row.rs_approval_status);
            $('#status_edit').val(row.rs_status);
            $('#hidden_id').val(reservation_id);
            $('#reservation_modal').modal('show'); 
             $.ajax({
             url :"/edit-reservation/"+reservation_id+"/",
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             dataType:"json",
             success:function(data)
             {
            $('#event_edit').val(row.event_id);
            $('#vehicle_edit').select2().val(vehicle_ids).change();
            $('#driver_edit').select2().val(driver_ids).change();
            $('#requestor_edit').val(row.requestor_id);
            $('#voucher_edit').val(row.rs_voucher);
            $('#approval_status_edit').val(row.rs_approval_status);
            $('#status_edit').val(row.rs_status);
            $('#hidden_id').val(reservation_id);
            $('#reservation_modal').modal('show'); 
             },
             error: function(data) {
             var errors = data.responseJSON;
             console.log(errors);
             }
             })
             });
         // EDIT---------------------------//
        //UPDATE------------------------------------------//
        $('#reservation_edit').on('submit', function(event) {   
                    event.preventDefault();
                    var action_url = "{{ url('/update-reservation')}}";

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
                                $('#reservation_modal').modal('hide');
                                $('#reservation_edit')[0].reset();
                                

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
        //CANCEL----------------------------------------------//
        var reservation_id;
        $(document).on('click', '.cancel', function() {
            reservation_id = $(this).attr('id');
            $('#confirm_message').text("Are You sure you want to Cancel?");
            $('#confirmModal').modal('show');
            $('#ok_button').prop('action','cancelled')
        });



        //CANCEL-----------------------------------------------//
        // DELETE---------------------------//
        var reservation_id;
        $(document).on('click', '.delete', function() {
            reservation_id = $(this).attr('id');
            $('#confirm_message').text("Are You sure you want to Delete?");
            $('#confirmModal').modal('show');
            $('#ok_button').prop('action','delete')
        });

        $('#ok_button').click(function() {
        var action = $(this).prop('action');
        if(action=='cancelled')
            {
            $.ajax({
                url: "/cancel-reservation/" + reservation_id
                , success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#reservations-table').DataTable().ajax.reload();
                    });
                }
            })
            }else{
                $.ajax({
                url: "/delete-reservation/" + reservation_id
                , success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#reservations-table').DataTable().ajax.reload();
                    });
                }
            })
            }


        });
        //DELETE---------------------------//
document.addEventListener("DOMContentLoaded", function() {
    var btn = document.getElementById("insertBtn");
    btn.addEventListener("click", function() {
        var insertModal = new bootstrap.Modal(document.getElementById("insertModal"));
        insertModal.show();
    });
});
});
    

</script>
@include('includes.footer');
</html>




