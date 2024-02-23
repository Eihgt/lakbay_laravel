<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drivers</title>
    <?php$title_page = 'Drivers';?>
    @include('includes.header')
</head>
<body>
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">Drivers</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <form action="" method="POST" class="" id="insert_form">
                @csrf
                <div class="card rounded-0">
                    <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                        Input/Filter Form
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="driver_id" value=">">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="dr_emp_id" class="form-label mb-0">Employee ID</label>
                                    <input type="text" class="form-control rounded-1" name="dr_emp_id" placeholder="Enter employee ID" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="dr_name" class="form-label mb-0">Full Name</label>
                                    <input type="text" class="form-control rounded-1" name="dr_name" placeholder="Enter driver's full name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Office</label>
                                <select name="dr_office" id="dr_office" class="form-control">
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->off_id }}">{{ $office->off_acr }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            
                            <div class="col">
                                <div class="mb-2">   
                                        <label for="dr_status">Status</label>
                                        <select name="dr_status" id="dr_status">
                                            <option value="Idle">Idle</option>
                                            <option value="Busy">Busy</option>
                                            <option value="On Travel">On Travel</option>
                                          </select>
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
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="sample_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<span id="form_result"></span>
<div class="container">
    <table class="table table-bordered driver-table" id="driver-table" name="driver-table">
        <thead>
            <tr>
                <th>EMP ID</th>
                <th>Name</th>
                <th>Office</th>
                <th>Status</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-------------EDIT MODAL --------------->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="driver_modal" name="driver_modal" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit New Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>EMP ID : </label>
                        <input type="text" name="dr_emp_id_modal" id="dr_emp_id_modal" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="dr_name_modal" id="dr_name_modal" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Office</label>
                        <select name="dr_office_modal" id="dr_office_modal" class="form-control">
                            <option id="off_value" name="off_value"></option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->off_id }}">{{ $office->off_acr }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="dr_status_modal" id="dr_status_modal">
                            <option value="Idle">Idle</option>
                            <option value="Busy">Busy</option>
                            <option value="On Travel">On Travel</option>
                          </select>
                    </div>
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-info"/>
                </div>
            </form>
        </div>
    </div>
</div> 
<!-------------EDIT MODAL --------------->

</body>

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#driver-table').DataTable({
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
        window.location.href='/driver-word';
                }
        },
        {
        text: 'Excel',
        action: function ( e, dt, node, config ) {
        window.location.href='/driver-excel';
                }
        }
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
    ajax: "{{ route('drivers.show') }}",
    columns: [
    {data: 'dr_emp_id', name: 'dr_emp_id'},
    {data: 'dr_name', name: 'dr_name'},
    {data: 'off_name', name: 'offices.off_name'},
    {data: 'dr_status', name: 'dr_status'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]

});
 // STORE---------------------------//
        $('#insert_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = "{{url('/insert-driver')}}";
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
                        $('#events-table').DataTable().ajax.reload();
                        $('#formModal').modal('hide');
                        $('#insert_form')[0].reset();

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
            //  alert(data.result.dr_emp_id);
             $('#dr_emp_id_modal').val(data.result.dr_emp_id);
             $('#dr_name_modal').val(data.result.dr_name);
             $('#off_value').text(data.result.off_acr);
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
@include('includes.footer')
</html>






