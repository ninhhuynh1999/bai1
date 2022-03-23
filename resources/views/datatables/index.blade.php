@extends('layouts.master')

@section('content')
    {{-- <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
    </table> --}}

    <br />
    <h3 align="center">Laravel 5.8 - Daterange Filter in Datatables with Server-side Processing</h3>
    <br />
           <br />
           <div class="row input-daterange">
               <div class="col-md-4">
                   <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
               </div>
               <div class="col-md-4">
                   <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
               </div>
               <div class="col-md-4">
                   <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                   <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
               </div>
           </div>
           <br />
  <div class="table-responsive">
   <table class="table table-bordered table-striped" id="order_table">
          <thead>
           <tr>
               <th>Order ID</th>
               <th>Customer Name</th>
               <th>Item</th>
               <th>Value</th>
                           <th>Date</th>
           </tr>
          </thead>
      </table>
  </div>
@stop

@push('scripts')
{{-- <script>    

$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script> --}}


<script>
$(document).ready(function(){
    $('.input-daterange').datepicker({
     todayBtn:'linked',
     format:'yyyy-mm-dd',
     autoclose:true
    });
   
    load_data();
   
    function load_data(from_date = '', to_date = '')
    {
     $('#order_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url:'{{ route("datatables.index2") }}',
       data:{from_date:from_date, to_date:to_date}
      },
      columns: [
       {
        data:'id',
        // name:'idd'
       },
       {
        data:'name',
        name:'name'
       },
       {
        data:'email',
        name:'email'
       },
     
       {
        data:'created_at',
        name:'created_at'
       }
      ]
     });
    }
   
    $('#filter').click(function(){
     var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();
     if(from_date != '' &&  to_date != '')
     {
      $('#order_table').DataTable().destroy();
      load_data(from_date, to_date);
     }
     else
     {
      alert('Both Date is required');
     }
    });
   
    $('#refresh').click(function(){
     $('#from_date').val('');
     $('#to_date').val('');
     $('#order_table').DataTable().destroy();
     load_data();
    });
   
   });
   </script>
@endpush