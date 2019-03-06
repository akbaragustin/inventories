@extends('layouts.index')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>USER</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form User</h5>
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
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email" id="email" class="email">
                </div>
              </div>
              <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                    <input id="password" type="password" name="password"  class="password" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm Password</label>
                  <div class="controls">
                    <input id="confirm_password" type="password" name="confirm_password"  class="confirm_password" />
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label">Telp</label>
                <div class="controls">
                  <input type="text" name="phone_number" id="phone_number" class="phone_number">
                </div>
              </div>
              <div class="control-group">
              <label class="control-label">Jabatan</label>
              <div class="controls">
                <select name="position_id" id="position_id" class="position_id" >
                <option value=""></option>
                  <?php 
                    foreach ($positions as $key => $value) {
                        $selected ="";
                        echo "<option value=".$value['id']." ".$selected.">".$value['name']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
              <div class="control-group">
              <label class="control-label">File upload input</label>
              <div class="controls">
                <input type="file" name="picture" id="picture" class="picture" />
                <img id="imgID" src=""  alt="" style="width:60px" class="imgID">
              </div>
            </div>
            <input type="hidden" name="picture_repeat"  class="picture_repeat" value="" id="picture_repeat">
            <input type="hidden" name="id" class="id" value ="" id="id">
            <input type="hidden" name="old_password"  class="old_password" value="" id="old_password">
          
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
            <h5>Data User</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $i = 1;
                  foreach ($users as $key => $value) {
                  
              ?>
                <tr class="gradeC">
                  <td>{{$i}}</td>
                  <td>{{$value['name']}} </td>
                  <td>{{$value['email']}}</td>
                  <td>{{$value['name_position']}}</td>
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
  var urlSaveUser ="{{url(route('user.create'))}}";
  var  urlEdit = "{{url('/admin/user/edit')}}";
  var  urlDelete = "{{url('/admin/user/delete')}}";
  $('#myTable').DataTable();
 //this is validation jquery
  $('#signupForm').validate({
          //condition form validate
          rules:{
              name :"required",
              email:"required",
              password: "required",
              confirm_password: {
                  equalTo: "#password"
              },
              position_id : "required",
          },
          //this is if form valid
          messages: {
              name :{
                  required : "Please enter your name",
              },
              email :{
                  required : "Please enter your email",
              },
              password :{
                  required : "Please enter your password",
              },
              confirm_password :{
                  equalTo : "Password not macth",
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
          formData.append('picture', $('#picture')[0].files[0]);
          formData.append('name', $('#name').val());
          formData.append('email', $('#email').val());
          formData.append('position_id', $('#position_id').val());
          formData.append('password', $('#password').val());
          formData.append('phone_number', $('#phone_number').val());
          formData.append('id', $('.id').val());
          formData.append('picture_repeat', $('.picture_repeat').val());
          formData.append('old_password', $('.old_password').val());
          formData.append('_token', $('#_token').val());
        
        
          //this is sent data to controller with ajax
          $.ajax({
              type: "POST",
              url: urlSaveUser,
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
                  var img = "{{URL::asset('')}}uploads/picture/"+retval.data.file_path;
                  $('.imgID').attr('src',img);
                  $(window).scrollTop(0);
                  var id = $('.id').val();
                  $('.picture_repeat').val(retval.data.file_path);
                  $('.id').val(retval.data.id);
                  $('#position_id').val(retval.data.position_id);
                  $('.name').val(retval.data.name);
                  $('.email').val(retval.data.email);
                  $('.old_password').val(retval.data.password);
                  $('.password').val(retval.data.password); 
                  $('.confirm_password').val(retval.data.password);
                  $('.phone_number').val(retval.data.phone_number);
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