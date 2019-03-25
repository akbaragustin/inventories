@include('layouts.header')
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
<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the current printer page size */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>

<body style="background-color:white">
<div class="row">
    <div class="cols-xs-4 cols-sm-4 pull-left" style="margin: 10px 30px 30px 30px;">
        <img src="{{URL::asset('')}}assets/images/favicon/logoprint.png" alt="" class="img" height="50">
    </div>
</div>
<div class="row">
    <div class="cols-xs-4 cols-sm-4 pull-left" style="margin-left: 30px;">
        <h2>{{$data['name']}}</h2>
    </div>
</div>
<br/>

<div class="row" style="padding-right:25px;padding-left:25px">
    <div class="cols-xs-12">
    <table border="0" style="width:100%" class="dataTablesRapat table table-striped js-basic-example listTable no-footer">
            <tr>
                <td width="200">Nama Barang</td>
                <td width="50"> : </td>
                <td> {{$data['name']}} </td>
            </tr>
            <tr>
                <td>Total Harga Barang</td>
                <td> : </td>
                <td> Rp. <span class="returnPrice">{{ $data['price']}} </span> </td>
            </tr>
            <tr>
                <td>Banyak Barang </td>
                <td> : </td>
                <td> {{$data['quantity']}} </td>
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
                <td><img src="{{URL::asset('')}}uploads/picture/{{$data['file_path']}}" alt="" class="img"></td>
            </tr>
    </table>
    </div>
</div>
    <input type="hidden" name="button"class="button_print">
    <input type="hidden" name="close"class="close">
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

$( '.returnPrice' ).mask('000.000.000.000.000', {reverse: true});

$('.button_print').click(function(){
    setTimeout(window.focus(),5000000);
    setTimeout($('.close').trigger('click'),500000);
})
$('.close').click(function(){
    window.print();
    window.close();
});
setTimeout($(".button_print").trigger('click'));
$('.dataTablesViewRapat').DataTable();
</script>
