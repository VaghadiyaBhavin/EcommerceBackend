@extends('adminlte::page')

@section('title', 'Update Product')

@section('content_header')
 <h4 style="display:inline-block;" class="mb-0">Update Product</h4>
    <div  style="display:inline-block; float:right;">
      <a class="btn-sm btn-primary" href="{{ route('product.index') }}"> Back</a> 
    </div>
  
@stop

@section('content')
<div class="card" style="padding: 20px;">
<br>


<form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>product Name * :</label>
                <input type="text" name="product_name" placeholder="Enter Product Name" class="form-control @error('product_name') is-invalid @enderror" value="{{$product->name}}" required>
                @if ($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Upc :</label>
                <input type="text" name="upc" class="form-control" value="{{$product->upc}}" disabled>
            </div>
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Price * :</label>
                <input type="number" name="price" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}" required>
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>
        </div>  

        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr/>
        </div>
        
        @if($shops != null)    
            @foreach($shops as $shop)
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">         
                        @php
                            $qty = null;                        
                            $key = -1;
                            $key = array_search($shop->id, array_column($stock_data, 'shop_id'))
                        @endphp 
                        @if($key > -1)
                            @php $qty = $stock_data[$key]['qty']; @endphp 
                        @endif
                        <label>{{$shop->name}}'s Stock :</label>
                        <input type="number" name="stock[]" placeholder="Enter Stock" value="{{$qty}}" class="form-control">
                    </div>
                </div>
            @endforeach
        @endif 

        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="{{ route('product.index') }}"> Cancel</a> 
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