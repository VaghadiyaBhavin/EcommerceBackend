@extends('adminlte::page')

@section('title', 'Shop List')

@section('content_header')

 <h4 style="display:inline-block;" class="mb-0">Shop List</h4>
    <div  style="display:inline-block; float:right;">
      <a class="btn-sm btn-success" href="{{ route('shop.create') }}"><i class="fa fa-plus"></i> New Shop</a>
    </div>
@stop
@section('content')

@if ($message = Session::get('success'))
    @section('js')
        <script>
           Swal.fire({
             position: 'center',
              icon: 'success',
              title: '<?php echo $message; ?>',
              showConfirmButton: false,
              timer: 1500,
            })
        </script>
    @stop
@endif

<x-adminlte-card theme="blue" theme-mode="outline">
<table id="shop_list" class="table table-hover">
<thead>
  <tr>
     <th>No</th>
     <th>Shop Name</th>
     <th>Coordinates</th>
     <th>Address</th>
     <th width="150px">Action</th>
  </tr>
  </thead>
</table>
</x-adminlte-card>

@endsection

@section('css')

@stop

@section('footer')
<script>
    $(document).ready(function(){
        $('#shop_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('shop.index') }}",
            columns: [
                { data: 'DT_RowIndex', 'searchable': false },
                { data: 'name' },
                { data: 'coordinates' },
                { data: 'address'},
                { data: 'action', orderable: false, searchable: false },
            ],
        });
    });
</script>
@endsection
