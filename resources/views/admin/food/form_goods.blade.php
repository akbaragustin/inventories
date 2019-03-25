 
    @foreach ($data as $key => $value)
     @foreach ($value as $ks => $vs)
        <label class="control-label"> Banyak {{$vs['name']}}  <span style="color:red">*</span></label>
        <div class="controls">
            <input type="text" name="quantity_{{$vs['name']}}" id="quantity" class="quantity" /><input type="text" style="width:5%" placeholder="{{$vs['unit']}}" disabled>
        </div>
    </div>
     @endforeach
    @endforeach
<script type="text/javascript">
$('.brand').change(function(){
    var id_brand = $(this).val();
    // if (id_brand == null) {
    //     $( ".form_pcs" ).empty();
    // }
        $.ajax({
                type: "GET",
                url: urlGetPcs,
                dataType : 'json',
                data: {
                    id_brand :id_brand
                },
                success: function(retval) {
                    $(retval).each(function(i,v){
                        console.log(v);
                        $('.views_'+v.name_all_category+'').attr('placeholder',v.stoke_category);
                        $('.pcs_asset_'+v.name_all_category+'').attr('max',v.stoke_category);
                        $('.pcs_asset_'+v.name_all_category+'').attr('placeholder',v.name_all_category);
                    });
                }
            });
        });
</script>
