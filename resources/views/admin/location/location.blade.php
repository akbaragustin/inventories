@extends('layouts.index')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>LOKASI</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form Lokasi</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal signupForm" id="signupForm" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Nama</label>
                <div class="controls">
                  <input type="text" name="name" id="name" class="name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Keterangan</label>
                <div class="controls">
                  <input type="text" name="description" id="description" class="description">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Kota</label>
                <div class="controls">
                  <input type="text" name="city" id="city" class="city">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Negara</label>
                <div class="controls">
                  <input type="text" name="country" id="country" class="country">
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
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  var urlSave ="{{url(route('location.create'))}}";
  var  urlEdit = "{{url('/admin/location/edit')}}";
  var  urlDelete = "{{url('/admin/location/delete')}}";
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