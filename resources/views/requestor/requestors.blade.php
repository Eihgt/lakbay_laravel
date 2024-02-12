<?php
    $title_page = 'LAKBAY Reservation System';
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
     @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @error('name')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover" id="requestor_table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Office</td>
                        <td>Actions</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
     <!-- boostrap requestor model -->
<div class="modal fade" id="requestor-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="RequestorModal"></h4>
      </div>
      <div class="modal-body">

        {{-- Editable Form --}}
        <form action="javascript:void(0)" id="requestorForm" name="requestorForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" maxlength="50" required="">
            </div>
          </div> 

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Company Email</label>
            <div class="col-sm-12">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Company Email" maxlength="50" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Company Address</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter Company Address" required="">
            </div>
          </div>

          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>
<!-- end bootstrap model -->

<script type="text/javascript">          
     $(document).ready( function () {
     
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#requestor_table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('requestors') }}",
               columns: [
                        { data: 'requestor_id', name: 'requestor_id' },
                        { data: 'rq_full_name', name: 'rq_full_name' },
                        { data: 'rq_office', name: 'rq_office' },
                        {data: 'action', name: 'action', orderable: false},
                     ],
                     order: [[0, 'desc']]
           });
     
      });
       
      function add(){
           $('#requestorForm').trigger("reset");
           $('#RequestorModal').html("Add Company");
           $('#requestor-modal').modal('show');
           $('#id').val(''); 
      }  

      function editFunc(id){
        $.ajax({
            type:"POST",
            url: "{{ url('edit-requestor') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#RequestorModal').html("Edit Company");
              $('#requestor-modal').modal('show');
              $('#requestor_id').val(res.requestor_id);
              $('#rq_full_name').val(res.rq_full_name);
              $('#rq_office').val(res.rq_office);           }
        });
      } 
     
      function deleteFunc(id){
            if (confirm("Delete Record?") == true) {
            var id = id;
              
              // ajax
              $.ajax({
                  type:"POST",
                  url: "{{ url('delete-requestor') }}",
                  data: { id: id },
                  dataType: 'json',
                  success: function(res){
     
                    var oTable = $('#requestor_table').dataTable();
                    oTable.fnDraw(false);
                 }
              });
           }
      }
      $('#requestorForm').submit(function(e) {     
         e.preventDefault();       
         var formData = new FormData(this);       
         $.ajax({
            type:'POST',
            url: "{{ url('store-requestor')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
              $("#requestor-modal").modal('hide');
              var oTable = $('#requestor_table').dataTable();
              oTable.fnDraw(false);
              $("#btn-save").html('Submit');
              $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
               console.log(data);
             }
           });
       });

    </script>
    
    @include('includes.footer'); 
