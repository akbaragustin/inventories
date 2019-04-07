@extends('layouts.index')
@section('content')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>DATA BAHAN MAKANAN PERLOKASI</h1>
  </div>

  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="pull-right button-right close hidden ">     
            <a href="#" class="closeRuangan padding">
                <div class="btn btn-danger waves-effect delete-menu material-icons">
                  <i class="fa fa-times"></i>
                </div>
            </a>
          </div>
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Filter Bahan Makanan</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal signupForm" id="signupForm" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Lokasi</label>
                <div class="controls">
                <select name="location_id" id="location_id" class="location_id select2-show-accessible">
                    <?php 
                        foreach ($locations as $key => $value) {
                            $selected ="";
                            echo "<option value=".$value['id']." ".$selected.">".$value['name']."</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Tanggal</label>
                <div class="controls">
                <input type="text" id="date_transaction" name="date_transaction" class="datepicker date_transaction" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                <input type="checkbox" name="status[]" value="1" class="status" id="status">Pemasukan <br>
                <input type="checkbox" name="status[]" value="2" class="status" id="status">Pengeluaran<br>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Shift</label>
                <div class="controls">
                <select name="shift" id="shift" class="shift">
                        <option value="1">1</option>
                        <option value="2">2</option>
                </select>
                </div>
              </div>
            
            <input type="hidden" name="id" class="id" value ="" id="id">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
              <div class="form-actions">
              <input class="submit btn btn-success" type="submit" value="submit"/>
              <input class="btn reset" type="reset" value="reset" id="reset"/>

                
             <!-- <input type="submit" value="Validate" class="btn btn-success"> -->
              </div>
            </form>
        <div class="pull-right button-right print hidden">
          <br>
          <a href="#" class="print">
          <div class="btn bg-blue-grey waves-effect edit-menu material-icons">
            <i class="fa fa-print"></i>
          </div>
          </a>
        </div>
            <div class="show">
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</div>

<!--end-main-container-part-->
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  var urlSave ="{{url(route('location.location.getTransaction'))}}";
  var  urlEdit = "{{url('/admin/location/edit')}}";
  var  urlDelete = "{{url('/admin/location/delete')}}";

  $( ".datepicker" ).datepicker();
  $('#myTable').DataTable();
  $( '.returnPrice' ).mask('000.000.000.000.000', {reverse: true});
 //this is validation jquery
  $('#signupForm').validate({
          //condition form validate
          rules:{
              location_id :"required",
              date_transaction :"required",
              status :"required",
              shift : "required"
             
          },
          //this is if form valid
          messages: {
              location_id :{
                  required : "Please enter your name",
              },
              date_transaction :{
                  required : "Please enter your city",
              },
              status :{
                  required : "Please enter your countrys",
              }, 
          },
          errorClass: "help-inline",
          errorElement: "span",
          highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
          },
      submitHandler: function(form) {
        
          //this is sent data to controller with ajax
          $.ajax({
              type: "GET",
              url: urlSave,
              dataType : 'json',
              data: $("#signupForm").serialize(),
              success: function(retval) {
                      // if sent save success then swall alert and reload page
                      if (retval.status == true){
                        $(".signupForm").addClass("hidden");
				                $( ".show" ).html(retval.data);
                        $(".print").removeClass("hidden");
                        $(".close").removeClass("hidden");
                        // var myWindow=  window.open("Report","report");
                        //     myWindow.open();
                        //     myWindow.document.write('<html><body>' + retval.data + '</body></html>');
                        //     myWindow.document.close();
                           
                      // this is save fails then swall alert error
                      }else if(retval.status == false){
                          swal("Save fails!",retval.messages, "error")
                      }
              }
          });
      }
  });
  $('.print').click(function(){
      w=window.open();
      w.document.write($(".show").html());
      w.print();
      w.close(); 
  });
  $('.closeRuangan').click(function(){
    location.reload();
  });
</script>
@endsection
@stop