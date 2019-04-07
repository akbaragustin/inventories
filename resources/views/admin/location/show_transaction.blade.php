<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    @if (!empty($data))
       <table order="1" width="100%">
       <tr>
        <th colspan="3"><center>PEMBELANJAAN</center></th>
        </tr>
        <tr>
            <th>Lokasi</th>
            <th>{{$data['location_name']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Shift</th>
            <th>{{$data['shift']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Keterangan</th>
            <th>{{$data['description']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th><?php echo date("d M Y",strtotime($data['date_transaction'])); ?></th>
            <th></th>
        </tr>
        <tr>
            <th>Bahan</th>
            <th>
                @foreach($data['food_detail'] as $key => $value) 
                
                {{$value['food_name']}} {{$value['quantity']}}{{$value['food_unit']}}
                <br>
                @endforeach
            </th>
            <th></th>
        </tr>
        <tr>
            <th>Harga Pembelanjaan</th>
            <th></th>
            <th>RP. <span class="returnPrice">{{$data['price']}}</span>.~</th>
            
        </tr>
      
    @endif

    @if (!empty($data_outcome)) 
    <tr>
        <th colspan="3"><center>PEMASUKAN</center></th>
    </tr>
        <tr>
            <th>Lokasi</th>
            <th>{{$data_outcome['location_name']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Shift</th>
            <th>{{$data_outcome['shift']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Keterangan</th>
            <th>{{$data_outcome['description']}}</th>
            <th></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th><?php echo date("d M Y",strtotime($data_outcome['date_transaction'])); ?></th>
            <th></th>
        </tr>
        <tr>
            <th>Sisa Bahan</th>
            <th>
                @foreach($data_outcome['food_detail'] as $key => $value) 
                
                {{$value['food_name']}} {{$value['quantity']}}{{$value['food_unit']}}
                <br>
                @endforeach
            </th>
            <th></th>
        </tr>
        <tr>
            <th>Harga Pengeluaran </th>
            <th></th>
            <th>RP. <span class="returnPrice">{{$data_outcome['price']}}</span>.~</th>
            
        </tr>
      
    @endif
    <tr>
        <th>Total</th>
        <th></th>
        <th>RP. @if($minus_calculate == 1) - @endif<span class="returnPrice">{{$calculate}}</span>.~</th>
    </tr>
    </table> 