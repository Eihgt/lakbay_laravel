<?php
    $title_page = 'LAKBAY Reservation System';
?>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{-- <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  @include('includes.header');
    <div class="row">
        <div class="col">
            <h4 class="text-uppercase">requestors</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <form action="{{url('/store-requestor')}}" method="POST" class="">
                <div class="card rounded-0">
                    <div class="card-header fs-6 bg-transparent text-dark rounded-0 pt-2 text-uppercase">
                        Input/Filter Form
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col btn-group">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Add Requestor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
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
            <label for="rq_full_name" class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="rq_full_name" name="rq_full_name" placeholder="Enter Full Name" maxlength="50" required="">
            </div>
          </div> 

          <div class="form-group">
            <label for="rq_office" class="col-sm-2 control-label">Office</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="rq_office" name="rq_office" placeholder="Enter Office" maxlength="50" required="">
            </div>
          </div>       

          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="btn-save">Update
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
           $('#RequestorModal').html("Add Requestor");
           $('#requestor-modal').modal('show');
           $('#id').val(''); 
      }  


      function editFunc(id){
        console.log(id);
        $.ajax({
            type:"POST",
            url: "{{ url('edit-requestor') }}",
            data: { requestor_id: id },
            dataType: 'json',
            success: function(res){
              $('#RequestorModal').html("Edit Requestor");
              $('#requestor-modal').modal('show');
              $('#rq_full_name').val(res.rq_full_name);
              $('#rq_office').val(res.rq_office);           
            }
        });
      } 
     
      function deleteFunc(id){
            if (confirm("Delete Record?") == true) {
            var requestor_id = requestor_id;
              // ajax
              $.ajax({
                  type:"POST",
                  url: "{{ url('/delete-requestor') }}",
                  data: { requestor_id: id },
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
