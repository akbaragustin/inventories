@extends('layouts.index')
@section('content')
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
                <input type="checkbox" name="vehicle" value="Bike">Pemasukan <br>
                <input type="checkbox" name="vehicle" value="Car">Pengeluaran<br>
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
  var urlSave ="{{url(route('location.create'))}}";
  var  urlEdit = "{{url('/admin/location/edit')}}";
  var  urlDelete = "{{url('/admin/location/delete')}}";

  $( ".datepicker" ).datepicker();
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
@endsection
@stop