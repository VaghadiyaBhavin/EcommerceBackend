@extends('adminlte::page')

@section('title', 'New Product')

@section('content_header')
<meta name="csrf-token" content="">
<h4 style="display:inline-block;" class="mb-0">New Product</h4>
    <div  style="display:inline-block; float:right;">
      <a class="btn-sm btn-primary" href="{{ route('product.index') }}"> Back</a> 
    </div>
@stop


@section('content')
<div class="card" style="padding: 20px;">
<br>

<form method="post" action="{{route('product.store')}}">
    @csrf
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>product Name * :</label>
                <input type="text" name="product_name" placeholder="Enter Product Name" class="form-control @error('product_name') is-invalid @enderror" value="{{old('product_name')}}" required>
                @if ($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Upc :</label>
                <input type="text" name="upc"class="form-control" value="{{App\Models\Product::generateUpc()}}" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Price * :</label>
                <input type="number" name="price" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" required>
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
                        <label>{{$shop->name}}'s Stock :</label>
                        <input type="number" name="stock[]" placeholder="Enter Stock" class="form-control">
                    </div>
                </div>
            @endforeach
        @endif
      
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-secondary" href="{{ route('product.index') }}"> Cancel</a> 
        </div>
    </div>
</form>
</div>
@endsection

@section('footer')
<script type="text/javascript">
</script>
@endsection