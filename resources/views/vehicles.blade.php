<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicles</title>
    <?php
    $title_page = 'LAKBAY Reservation System';   
?>
@include('includes.header');
</head>
<body>
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
                        <input type="hidden" name="vehicle_id" value="">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_plate_number" class="form-label mb-0">Plate Number</label>
                                    <input type="text" class="form-control rounded-1" name="vh_plate_number" placeholder="Enter vehicle name" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_type" class="form-label mb-0">Type</label>
                                    <input type="text" class="form-control rounded-1" name="vh_type" placeholder="Enter vehicle's venue" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_brand" class="form-label mb-0">Brand</label>
                                    <input type="text" class="form-control rounded-1" name="vh_brand" placeholder="Enter vehicle's start date" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_year" class="form-label mb-0">Year</label>
                                    <input type="number" class="form-control rounded-1" name="vh_year" placeholder="Enter vehicle's start time" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_fuel_type" class="form-label mb-0">Fuel Type</label>
                                    <input type="text" class="form-control rounded-1" name="vh_fuel_type" placeholder="Enter vehicle's end date" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_condition" class="form-label mb-0">Condition</label>
                                    <input type="text" class="form-control rounded-1" name="vh_condition" placeholder="Enter vehicle's end time" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vh_status" class="form-label mb-0">Status</label>
                                    <input type="text" class="form-control rounded-1" name="vh_status" placeholder="Enter date added" value="">
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

    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover vehicles-table" id="vehicles-id" name="vehicles-id">
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
    <script type="text/javascript">
        $(document).ready(function() {
        var table = $('.vehicles-table').DataTable({
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
                    window.location.href='/reservations-word';
                }
            },
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
        ajax: "{{ route('vehicles.show') }}",
        columns: [
        {data: 'vehicle_id', name: 'vehicle_id'},
        {data: 'vh_plate', name: 'vh_plate'},
        {data: 'vh_type', name: 'vh_type'},
        {data: 'vh_brand', name: 'vh_brand'},
        {data: 'vh_year', name: 'vh_year'},
        {data: 'vh_fuel_type', name: 'vh_fuel_type'},
        {data: 'vh_condition', name: 'vh_condition'},
        {data: 'vh_status', name: 'vh_status'},
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
</body>
@include('includes.footer');
</html>


   

