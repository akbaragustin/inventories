<!DOCTYPE html>
<html lang="en">
<head>
<title>Bubur C7</title>
<link rel="icon" href="{{ URL::asset('')}}plugins/img/profile.jpeg" type="image/x-icon">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/demo.css" />
<!-- PENTING -->
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/datepicker.css" /> 
<!-- <link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/select2.css" /> -->
   <!-- datePicker required styles -->
<link rel="stylesheet" type="text/css" media="screen" href="styles/datePicker.css">

<!-- PENTING -->
  
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/uniform.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/matrix-style.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/matrix-media.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/bootstrap-wysihtml5.css" />
<link href="{{ URL::asset('') }}plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>
</head>
@include('layouts.menu_top')
@include('layouts.side')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Barang</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form Barang</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal signupForm" id="signupForm" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <label>
                  <input type="radio" name="type" value='1' />
                  Pemasukan</label>
                <label>
                  <input type="radio" name="type" value='2' />
                  Pengeluaran</label>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label">Nama Barang</label>
                <div class="controls">
                  <input type="text" name="name" id="name" class="name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Lokasi</label>
                <div class="controls">
                  <select name="location_id" id="location_id" class="location_id">
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
                <label class="control-label">Shift Kerja</label>
                  <div class="controls">
                    <label>
                      <input type="radio" name="type" value='1' />
                      1 (Satu)</label>
                    <label>
                      <input type="radio" name="type" value='2' />
                      2 (Dua)</label>
                  </div>
              </div>
              <div class="control-group">
                <label class="control-label">Banyak Barang</label>
                <div class="controls">
                  <input type="number" name="quantity" id="quantity" class="quantity">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Total Harga Barang</label>
                <div class="controls">
                  <input type="number" name="price" id="price" class="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Keterangan</label>
                <div class="controls">
                  <input type="text" name="description" id="description" class="description">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Keterangan</label>
                <div class="controls">
                  <input type="text" name="description" id="description" class="description">
                </div>
              </div>
              <div class="control-group">
              <label class="control-label">Date Picker (mm-dd)</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Lokasi</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kota</th>
                  <th>Negara</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $i = 1;
                  foreach ($locations as $key => $value) {
                  
              ?>
                <tr class="gradeC">
                  <td>{{$i}}</td>
                  <td>{{$value['name']}} </td>
                  <td>{{$value['city']}} </td>
                  <td>{{$value['country']}} </td>
                  <td>
                                            <a class="btn bg-blue-grey waves-effect edit-menu material-icons" onclick="editProcess({{$value['id']}})">
                                                edit
                                            </a>

                                            <div class="btn btn-danger waves-effect delete-menu material-icons" onclick="deletProcess({{$value['id']}})">
                                                delete
                                            </div>

                </td>
                </tr>
                  <?php $i++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<script src="{{ URL::asset('') }}plugins/js/jquery.min.js"></script> 
<!-- jquery.datePicker.js -->
<script type="text/javascript" src="scripts/jquery.datePicker.js"></script>

<script src="{{ URL::asset('') }}plugins/js/jquery.ui.custom.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/bootstrap.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.toggle.buttons.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/masked.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/matrix.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/wysihtml5-0.3.0.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.peity.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/bootstrap-wysihtml5.js"></script> 

<script src="{{ URL::asset('') }}plugins/js/bootstrap-colorpicker.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/bootstrap-datepicker.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.uniform.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/select2.min.js"></script> 

<script src="{{ URL::asset('') }}plugins/js/matrix.form_common.js"></script> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
  var urlSave ="{{url(route('location.create'))}}";
  var  urlEdit = "{{url('/admin/location/edit')}}";
  var  urlDelete = "{{url('/admin/location/delete')}}";
  // Format mata uang.
  $( '.price' ).mask('000.000.000', {reverse: true});

  $('#myTable').DataTable();
 //this is validation jquery
  $('#signupForm').validate({
          //condition form validate
          rules:{
              name :"required",
              city :"required",
              country :"required",
             
          },
          //this is if form valid
          messages: {
              name :{
                  required : "Please enter your name",
              },
              city :{
                  required : "Please enter your city",
              },
              country :{
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
          //thi is get data form
          var formData = new FormData();
       
          formData.append('name', $('#name').val());
          formData.append('city', $('#city').val());
          formData.append('country', $('#country').val());
          formData.append('description', $('#description').val());
          formData.append('id', $('.id').val());
          formData.append('_token', $('#_token').val());
        
        
          //this is sent data to controller with ajax
          $.ajax({
              type: "POST",
              url: urlSave,
              dataType : 'json',
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              success: function(retval) {
                      // if sent save success then swall alert and reload page
                      if (retval.status == true){
                          $('#reset').trigger('click');
                          $('.imgID').remove();
                          swal(retval.messages, "You clicked the button!", "success").then((willDelete) => {
                              if (willDelete) {
                                location.reload();
                              } else {
                                location.reload();
                              }
                            });  
                          
                      // this is save fails then swall alert error
                      }else if(retval.status == false){
                          swal("Save fails!",retval.messages, "error")
                      }
              }
          });
      }
  });

  function editProcess(id){
      $.ajax({
          type: "GET",
          url: urlEdit,
          dataType : 'json',
          data: {
              id :id
          },
          success:function(retval) {
              if (retval.status =true) {
                  $(window).scrollTop(0);
                  $('.id').val(retval.data.id);
                  $('.name').val(retval.data.name);
                  $('.city').val(retval.data.city);
                  $('.country').val(retval.data.country);
                  $('.description').val(retval.data.description);
                  $('.submit').val(retval.data.submit);
                  
              }else{
              swal("Fails!",retval.messages, "error")
              }

          }
      });
  } 
    //function delete
  function deletProcess(id){
    swal({
      title: "Apa anda yakin?",
      text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = urlDelete+'/'+id;
        swal("Data Telah Terhapus", {
          icon: "success",
        });
      } else {
        swal("Data Tetap Tersimpan!");
      }
    });
  }
  

</script>
