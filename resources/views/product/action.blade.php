<style type="text/css">
    .inline { 
        display: inline-block; 
        margin:2px;
    }
</style>

<div>

  <div class="inline"><a class="btn btn-xs btn-default text-teal" href="{{ route('product.edit',$id) }}"><i class="fa fa-lg fa-fw fa-edit"></i></a>
  <div class="inline custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="customSwitch{{$id}}" data-id="{{$id}}"  <?php echo ($is_active==1 ? 'checked' : '');?>>
    <label class="custom-control-label" for="customSwitch{{$id}}"></label>
  </div>
        


</div>


<!-- ajx call where toggle button click -->
<script type="text/javascript">
$(document).on('change', '#customSwitch{{$id}}', function(){
  var status = $(this).prop('checked') == true ? 1 : 0;
  var id = $(this).data('id');
  $.ajax({
      method: 'get',
      url: '{{ url('ProductchangeStatus')}}/'+status+'/'+id,
  });
});
</script>