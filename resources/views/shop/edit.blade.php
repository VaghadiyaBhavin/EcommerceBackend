@extends('adminlte::page')

@section('title', 'Update Shop')

@section('content_header')
 <h4 style="display:inline-block;" class="mb-0">Update Shop</h4>
    <div  style="display:inline-block; float:right;">
      <a class="btn-sm btn-primary" href="{{ route('shop.index') }}"> Back</a> 
    </div>
  
@stop

@section('content')
<div class="card" style="padding: 20px;">
<br>


<form method="post" action="{{route('shop.update',$shop->id)}}" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Shop Name * :</label>
                <input type="text" name="shop_name" placeholder="Enter Shop Name" class="form-control @error('shop_name') is-invalid @enderror" value="{{$shop->name}}" required>
                @if ($errors->has('shop_name'))
                    <span class="text-danger">{{ $errors->first('shop_name') }}</span>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Coordinates * :</label>
                <input type="text" name="coordinates" placeholder="Enter Coordinates" class="form-control @error('coordinates') is-invalid @enderror" value="{{$shop->coordinates}}" required>
                @if ($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Address * :</label>
                <textarea type="text" name="address" placeholder="Enter Address" class="form-control @error('address') is-invalid @enderror" required>{{$shop->address}}</textarea>
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="{{ route('shop.index') }}"> Cancel</a> 
        </div>
    </div>
</form>
</div>

@endsection
@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
       //$('.ckeditor').ckeditor();
    });
</script>
@endsection