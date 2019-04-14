@include('layouts.header')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@include('layouts.menu_top')
<style media="screen">
.img {
width:200px;
}
.button-right{
    padding-right:40px;
}
.padding{
    padding-left: :20px;
}
.button{
    padding-right:20px;
}
.design{
    padding-left:120px;
}
</style>
<body style="background-color:white">
    <div class="main-content">
        <div class="pull-right button-right">
            <br>
            <a href="#" class="print">
            <div class="btn bg-blue-grey waves-effect edit-menu material-icons">
            <i class="fa fa-print"></i>
            </div>
            </a>
            <a href="#" class="closeRuangan padding">
            <div class="btn btn-gray waves-effect delete-menu material-icons">
                <i class="fa fa-times"></i>
            </div>
            </a>
        </div>
        <div class="container">  
            <div class="row">
                <div class="cols-xs-4 cols-sm-4 pull-left" style="margin-left: 30px;">
                    <br>
                    <a href="{{URL::asset('')}}uploads/picture/{{$data['file_path']}}"><img src="{{URL::asset('')}}uploads/picture/{{$data['file_path']}}" alt="" class="img"></a>
                </div>
            </div>
            <br/>
            <div class="row" style="padding-right:25px;padding-left:25px">
                <div class="cols-xs-12">
                    <table border="0" style="width:100%" class="dataTablesRapat table table-striped js-basic-example listTable no-footer">
                        <tr>
                            <td>Total Harga Barang</td>
                            <td> : </td>
                            <td> Rp. <span class="returnPrice">{{ $data['price']}} </span> </td>
                        </tr>
                        <tr>
                            <td>Lokasi </td>
                            <td> : </td>
                            <td> {{$data['location_name']}} </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td> : </td>
                            <td> <?php echo date("d M Y H:i:s",strtotime($data['date_transaction'])); ?> </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td> : </td>
                            <td> {{$data['description']}} </td>
                        </tr>
                        <tr>
                            <td>Shift</td>
                            <td> : </td>
                            <td> {{$data['shift']}} </td>
                        </tr>
                        <tr>
                            <td>Dibuat Oleh</td>
                            <td> : </td>
                            <td> {{$data['user_name']}} </td>
                        </tr>
                        <tr>
                            <td>Tanggal dibuat</td>
                            <td> : </td>
                            <td> <?php echo date("d M Y H:i:s",strtotime($data['created_at'])); ?> </td>
                        </tr>
                        <tr>
                            <td>Diperbarui Pada Tanggal</td>
                            <td> : </td>
                            <td> <?php echo date("d M Y H:i:s",strtotime($data['updated_at'])); ?> </td>
                        </tr>
                        <tr>
                        <td colspan="3"><center>  PENGELUARAN BARANG </center> </td>
                        </tr>
                        @foreach($data['transaction_goods'] as $key => $value) 
                        <tr>
                            <td>{{$value['food_name']}}</td>
                            <td> : </td>
                            <td>
                                {{$value['quantity']}} / {{$value['food_unit']}}
                            
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<!--end-Footer-part-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ URL::asset('') }}plugins/js/excanvas.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.min.js"></script> 
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ URL::asset('') }}plugins/js/jquery.ui.custom.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/bootstrap.min.js"></script> 
<!-- <script src="{{ URL::asset('') }}plugins/js/select2.min.js"></script>  -->
	<!--end-Footer-part-->
<script src="{{ URL::asset('') }}plugins/js/jquery.flot.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.flot.resize.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.peity.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/fullcalendar.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.dataTables.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.tables.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.dashboard.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.gritter.min.js"></script>
<script src="{{ URL::asset('') }}plugins/js/matrix.interface.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.chat.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.validate.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.form_validation.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.wizard.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.uniform.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.popover.js"></script> 

    <script type="text/javascript">
        var urlPrint = "{{url('/admin/food-print')}}";
        var dataId = "{{$data['id']}}"
    </script>
<script type="text/javascript">
$('.closeRuangan').click(function(){
     window.close();
});

$( '.returnPrice' ).mask('000.000.000.000.000', {reverse: true});
$('.print').click(function(){

    window.open(urlPrint+"?id="+dataId,"width=800px, height=500px");
});
$('.dataTablesViewRapat').DataTable();
</script>
