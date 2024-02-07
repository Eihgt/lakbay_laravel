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
            <form action="{{url('/insertRequestors')}}" method="POST" class="">
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
                {{-- <tbody>
                    <tr>
                        
                    </tr>
                        <tr>
                            <td colspan="6">No records found</td>
                        </tr>
                </tbody> --}}
            </table>
        </div>
        <span id="form_result" name="form_result"></span>

        
<!--- DELETE MODAL --->
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
<!--- DELETE MODAL --->


 
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.table-hover').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('requestors.show') }}"
            , columns: [
            {data: 'requestor_id', name: 'requestor_id'},
            {data: 'rq_full_name', name: 'rq_full_name'},
            {data: 'rq_office', name: 'rq_office'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

            $('#sample_form').on('submit', function(event){
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
                    $('#sample_form')[0].reset();
                    
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
             $('#requestor_id').val(data.result.requestor_id);
             $('#rq_full_name').val(data.result.rq_full_name);
             $('#rq_office').val(data.result.rq_office);
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
    </div>
    @include('includes.footer'); 
