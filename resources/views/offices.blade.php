<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offices</title>
    @include('includes.header') 
</head>
<body>
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">Offices</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <form action="" method="POST" class="insert_form" id="insert_form">
                @csrf
                <div class="card rounded-0">
                    <div class="card-body">
                        <input type="hidden" name="driver_id" value=">">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="off_acr" class="form-label mb-0">Office Acronym</label>
                                    <input type="text" class="form-control rounded-1" name="off_acr" placeholder="Enter Office acronym" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="off_name" class="form-label mb-0">Office Full Name</label>
                                    <input type="text" class="form-control rounded-1" name="off_name" placeholder="Enter office's full name" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="off_head" class="form-label mb-0">Office Head</label>
                                    <input type="text" class="form-control rounded-1" name="off_head" placeholder="Enter  office's head" value="">
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
    <div class="container">
        <span id="form_result"></span>
        <table class="table table-bordered office-table" id="office-table" name="office_table">

            <thead>
                <tr>
                    <th>Office Acr</th>
                    <th>Name</th>
                    <th>Office Head</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <span id="form_result" name="form_result"></span>
<!--- EDIT--->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="office_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label>Office ACR : </label>
                                <input type="text" name="off_acr" id="off_acr" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Name : </label>
                                <input type="text" name="off_name" id="off_name" class="form-control" />
                            </div>
                            <div class="form-group editpass">
                                <label>Office Head </label>
                                <input type="text" name="off_head" id="off_head" class="form-control" />
                            </div>
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-info" />
                        </div>
                    </form>
                </div>
            </div>
        </div> 

<!--- EDIT & STORE MODAL --->

<!--- DELETE MODAL --->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="office_form" class="form-horizontal">
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
<!--- DELETE MODAL --->


    </body>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           var table = $('.office-table').DataTable({
            search: {
            return: true
            },
             processing: true
            , serverSide: true
            ,dom: 'Bfrtip',
            buttons: [
        {
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'copy',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: ':visible'
            }
        },
        'colvis'
    ]
            , ajax: "{{ route('offices.show') }}"

            , columns: [{
            data: 'off_acr'
            , name: 'off_acr'
            }
            , {
            data: 'off_name'
            , name: 'off_name'
            }
            , {
            data: 'off_head'
            , name: 'off_head'
            }
            , {
            data: 'action'
            , name: 'action'
            , orderable: false
            , searchable: false
            }
            , ]
            

            });
        $('#office_form').on('submit', function(event){
        event.preventDefault(); 
        var action_url = '';
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ url('/update-office') }}";

        }
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_url,
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log('success: '+data);
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if(data.success) 
                {
                    html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;"+data.success+"</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
                    $('#office-table').DataTable().ajax.reload();
                    $('#formModal').modal('hide');
                    $('#office_form')[0].reset();
                    
                }
                $('#form_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });

    $('#insert_form').on('submit', function(event){
        event.preventDefault(); 
        var action_url = "{{ url('/insert-office') }}";
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_url,
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log('success: '+data);
                var html = '';
                if(data.success) 
                {
                    html = "<div class='alert alert-info alert-dismissible fade show py-1 px-4 d-flex justify-content-between align-items-center' role='alert'><span>&#8505; &nbsp;"+data.success+"</span><button type='button' class='btn fs-4 py-0 px-0' data-bs-dismiss='alert' aria-label='Close'>&times;</button></div>";
                    $('#office-table').DataTable().ajax.reload();
                    $('#insert_form')[0].reset();
                    
                }
                $('#form_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });
            //EDIT---------------------------//
             $(document).on('click', '.edit', function(event){
             event.preventDefault();
             var off_id= $(this).attr('id');
            //  alert(off_id);
             $('#form_result').html('');
             $.ajax({
             url :"/edit-office/"+off_id+"/",
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             dataType:"json",
             success:function(data)
             {
             $('#off_acr').val(data.result.off_acr);
             $('#off_name').val(data.result.off_name);
             $('#off_head').val(data.result.off_head);
             $('#hidden_id').val(off_id);
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
             //EDIT---------------------------//
             //DELETE---------------------------//
            var off_id;
            $(document).on('click', '.delete', function(){
            off_id = $(this).attr('id');

            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/delete-office/"+off_id,
            success:function(data)
            {
            setTimeout(function(){
            $('#confirmModal').modal('hide');
            $('#office-table').DataTable().ajax.reload();
            });
            }   
            })
            });
            //DELETE---------------------------//
            });

</script>

@include('includes.footer');
</body>

</html>