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
            <form action="" method="POST" class="">
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
                                        <option value="">Select an event</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="driver_id" class="form-label mb-0">Driver</label>
                                    <select class="form-select" name="driver_id">
                                        <option value="">Select driver</option>
                                     
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="vehicle_id" class="form-label mb-0">Vehicle</label>
                                    <select class="form-select" name="vehicle_id">
                                        <option value="">Select vehicle</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="requestor_id" class="form-label mb-0">Requestor</label>
                                    <select class="form-select" name="requestor_id">
                                        <option value="">Select requestor</option>
                                      
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="rs_voucher" class="form-label mb-0">Voucher</label>
                                    <input type="text" class="form-control rounded-1" name="rs_voucher" placeholder="Enter reservation name" value="">
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
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="rs_date_filed" class="form-label mb-0">Date of Filing</label>
                                    <input type="date" class="form-control rounded-1" name="rs_date_filed" placeholder="Enter reservation's start time" value="">
                                </div>
                            </div>
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
            <table class="table table-bordered table-hover" id="reservations-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Event</td>
                        <td>Driver</td>
                        {{-- <td>Vehicle</td>
                        <td>Requestor</td>
                        <td>Voucher</td>
                        <td>DT</td>
                        <td>OP</td>
                        <td>Filing</td>
                        <td>Approval</td>
                        <td>Status</td>
                        <td>Actions</td> --}}
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            <script>
                const ajaxUrl = @json(route('get-reservations'));
                const cat = 'reservations';
                const token = "{{ csrf_token() }}";
              </script>
               <script type="text/javascript">
                $(document).ready(function(){
                   $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                       });
                  var table = $('#reservations-table');
                  var title = "List of registered reservations in the system";
                  var columns = [0, 1, 2, 3];
                  var dataColumns = [
                       {data: 'checkbox', name:'checkbox'},
                       {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,  searchable: false },
                       {data: 'reservation_id', name:'reservation_id'},
                    //    {data: 'rs_voucher', name:'rs_voucher'},
                    //    {data: 'rs_daily_transport', name:'rs_daily_transport'},
                    //    {data: 'rs_outside_province', name:'rs_outside_province'},
                    //    {data: 'rs_date_filed', name:'rs_date_filed'},
                    //    {data: 'rs_approval_status', name:'rs_approval_status'},
                    //    {data: 'rs_status', name:'rs_status'},
                       {data: 'event_id', name:'event_id'},
                       {data: 'driver_id', name:'driver_id'},
                    //    {data: 'vehicle_id', name:'vehicle_id'},
                       {data: 'requestor_id', name:'requestor_id'},
                       {data: 'action', name: 'action',orderable: false,searchable: false},
                   ];
                   makeDataTable(table, title, columns, dataColumns);
              });
              
              
              function makeDataTable(table, title, columnArray, dataColumns) {
              
                   $(table).dataTable({
                       dom:
                           "<'row'<'col-sm-1'l><'col-sm-8 pb-3 text-center'B><'col-sm-3'f>>" +
                           "<'row'<'col-sm-12'tr>>" +
                           "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                       processing: true,
                       stateSave: true,
                       pageLength:15,
                       "lengthMenu": [ [10, 15, 25, 50, -1], [10, 15, 25, 50, "All"] ],
                           buttons: [
                               {
                                   text: "<i></i> Select all",
                                   className: "btn btn-primary btn-sm btn-select-all",
                                   action: function(e, dt, node, config) {
                                       selectAllCheckBoxes();
                                   }
                               },
                
                               {
                                   text: "<i></i> Deselect all",
                                   className: "btn btn-info btn-sm",
                                   action: function(e, dt, node, config) {
                                       deselectAllCheckBoxes();
                                   }
                               },
                
                               $.extend(
                                   true,
                                   {},
                                   {
                                       extend: "excelHtml5",
                                       text: '<i class="fa fa-download "></i> Excel',
                                       className: "btn btn-default btn-sm",
                                       title: title,
                                       exportOptions: {
                                           columns: columnArray
                                       }
                                   }
                               ),
                
                               $.extend(
                                   true,
                                   {},
                                   {
                                       extend: "pdfHtml5",
                                       text: '<i class="fa fa-download"></i> Pdf',
                                       className: "btn btn-default btn-sm",
                                       title: title,
                                       exportOptions: {
                                           columns: columnArray
                                       }
                                   }
                               ),
                
                               $.extend(
                                   true,
                                   {},
                                   {
                                       extend: "print",
                                       exportOptions: {
                                           columns: columnArray,
                                           modifier: {
                                               selected: null
                                           }
                                       },
                                       text: '<i class="fa fa-save"></i> Print',
                                       className: "btn btn-default btn-sm",
                                       title: title
                                   }
                               ),
                
                               {
                                   text: "<i></i> Delete selected",
                                   className: "btn btn-danger btn-sm btn-deselect-all",
                                   action: function(e, dt, node, config) {
                                       deleteSelectedRows(table);
                                   }
                               }
                           ],
                       ajax: ajaxUrl,
                       columns: dataColumns,
                       order: [[0, "asc"]]
                   });
              
                  }
              
              </script>
        </div>
    </div>
</body>
@include('includes.footer');
</html>





