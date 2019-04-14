@extends('layouts.index')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo url('/admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
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
            <form class="form-horizontal assetForm" id="assetForm" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Nama Barang <span style="color:red">*</span></label>
                <div class="controls">
                  <input type="text" name="name" id="name" class="name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Lokasi <span style="color:red">*</span></label>
                <div class="controls">
                  <select name="location_id" id="location_id" class="location_id">
                    <option value=""></option>
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
                <label class="control-label">Shift Kerja <span style="color:red">*</span></label>
                  <div class="controls">
                  <select name="shift" id="shift" class="shift"> 
                  <option value=""></option>
                        <option value="1">1 (Satu) </option>
                        <option value="2">2 (Dua) </option>
                  </select>
              </div>
              <div class="control-group">
                <label class="control-label">Banyak Barang <span style="color:red">*</span></label>
                <div class="controls">
                  <input type="number" name="quantity" id="quantity" class="quantity">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Total Harga Barang <span style="color:red">*</span></label>
                <div class="controls">
                  <input type="text" name="price" id="price" class="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Keterangan</label>
                <div class="controls">
                  <input type="text" name="description" id="description" class="description">
                </div>
              </div>
              <div class="control-group">
              <label class="control-label">Tanggal <span style="color:red">*</span></label>
              <div class="controls">
                  <input type="text" id="date_transaction" name="date_transaction" class="datepicker date_transaction" >
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Upload Nota <span style="color:red">*</span></label>
              <div class="controls">
                <input type="file" name="picture" id="picture" class="picture" />
                <img id="imgID" src=""  alt="" style="width:60px" class="imgID">
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
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Tanggal</th>
                  <th>Lokasi</th>
                  <th>Shift</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $i = 1;
                  foreach ($assets as $key => $value) {
                  
              ?>
                <tr class="gradeC">
                  <td>{{$i}}</td>
                  <td>{{$value['name']}} </td>
                  <td><span class="returnPrice">{{$value['price']}} </span></td>
                  <td><?php echo date("d M Y",strtotime($value['date_transaction'])); ?></td>
                  <td>{{$value['location_name']}} </td>
                  <td>{{$value['shift']}}</td>
                  <td>
                    <a class="btn bg-blue-grey waves-effect edit-menu material-icons" onclick="editProcess({{$value['id']}})">
                        edit
                    </a>

                    <div class="btn btn-danger waves-effect delete-menu material-icons" onclick="deletProcess({{$value['id']}})">
                        delete
                    </div>
                    <div class="btn bg-blue-grey waves-effect edit-menu material-icons" onclick="showProcess({{$value['id']}})">
                      show
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
  var urlSave ="{{url(route('asset.create'))}}";
  var  urlEdit = "{{url('/admin/asset/edit')}}";
  var  urlDelete = "{{url('/admin/asset/delete')}}";
  var urlAjaxShow = "{{url('/admin/asset-show')}}";
  $( ".datepicker" ).datepicker();
  
  $( '.returnPrice' ).mask('000.000.000.000.000', {reverse: true});
  // Format mata uang.
  $( '.price' ).mask('000.000.000.000.000', {reverse: true});
  $('#myTable').DataTable();
 //this is validation jquery
  $('.assetForm').validate({
          //condition form validate
          rules:{
            shift :"required",
              name :"required",
              location_id :"required",
              quantity :"required",
              tanggal :"required",
              price : "required",
             
          },
          //this is if form valid
          messages: {
              name :{
                  required : "Silahkan masukan nama anda",
              },
              shift :{
                  required : "Silahkan masukan shift anda",
              },
              location_id :{
                  required : "Silahkan masukan lokasi anda",
              },
              quantity :{
                  required : "Silahkan masukan banyak barang anda",
              },
              date_transaction :{
                  required : "Silahkan masukan tanggal transaksi anda",
              },
              price :{
                  required : "Silahkan masukan total harga",
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
          formData.append('location_id', $('#location_id').val());
          formData.append('shift', $('.shift').val());
          formData.append('quantity', $('#quantity').val());
          formData.append('price', $('#price').val());
          formData.append('description', $('#description').val());
          formData.append('date_transaction', $('#date_transaction').val());
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
                          swal("failed to save data!",retval.messages, "error")
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
                  $('.id').val(retval.data.id);
                  $('.name').val(retval.data.name);
                  $('.location_id').val(retval.data.location_id);
                  $('.shift').val(retval.data.shift);
                  $('.quantity').val(retval.data.quantity);
                  $('.price').val(retval.data.price);
                  $('.description').val(retval.data.description);
                  $('.date_transaction').val(retval.data.date_transaction);
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
  //show Detail data by id
    function showProcess(id_asset){
        window.open(urlAjaxShow+"?id_asset="+id_asset,"width=800px, height=500px");
    }

</script>

@endsection
@stop