@foreach($foods as $key => $value)
        <div class="control-group">
                <label class="control-label">Sisa {{$value['food_name']}}</label>
                <div class="controls">
                  <input  step="0.01" name="{{$value['food_id']}}" type="number" id="foodsBefore" class="foodsBefore"  value="{{$value['quantity']}}" style="width:50px" disabled>
                  <input  step="0.01" name="{{$value['food_id']}}" id="foods" class="foods" type ="number" max="{{$value['quantity']}}"  min="0" style="width:140px">
                </div>
        </div>
@endforeach