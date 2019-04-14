@extends('layouts.index')
@section('content')
  <?php if (!empty($payday)) { ?>
    <input type="hidden" name="exist" value="exist" class="data">
   <?php  }else {  ?>
    <input type="hidden" name="exist" value="not" class="data">
    <?php  }  ?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo url('/admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <!-- <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="index.html"> <i class="icon-dashboard"></i> <span class="label label-important">20</span> My Dashboard </a> </li>
        <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>
        <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Widgets </a> </li>
        <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
        <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
        <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>

      </ul>
    </div> -->
<!--End-Action boxes--> 
<!--Chart-box--> 
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span6">
              <div class="chart"></div>
            </div>
            <div class="span6">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php  echo $foods_income_count;  ?></strong> <small>Total Bahan Masuk</small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong> <?php  echo $foods_outcome_count;  ?></strong> <small>Total Bahan Keluar</small></li>
                <li class="bg_lh"><i class="icon-money"></i> <strong> RP. <span class="returnPrice"><?php  echo $price_income_count;  ?></span></strong> <small>Total Uang Masuk</small></li>
                <li class="bg_lh"><i class="icon-money"></i> <strong> RP. <span class="returnPrice"><?php  echo $price_outcome_count;  ?></span></strong> <small>Total Uang Keluar</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>  <?php  echo $user_count;  ?></strong> <small>Total Karyawan</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    <hr/>
  </div>

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Peringatan !!!</h4>
        </div>
        <div class="modal-body">
        <?php if (!empty($payday)) { ?>
            <table width="100%" border="1">
              <tr>
                <td>Name</td>
                <td>Tanggal Gajihan</td>
              </tr>
            <?php foreach($payday as $key => $value){ ?>
              <tr>
                <td> <?php  echo $value['name'];  ?></td>
                <td> <?php  echo date("d M Y", strtotime($value['date_payday']));  ?></td>
              </tr>
            <?php  }  ?>
            </table>
          <?php  }  ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!--end-main-container-part-->
@section('js')
<script>
   var data = $('.data').val();
   console.log(data)
  if (data == "exist") {
    $("#myModal").modal();
  }
  $( '.returnPrice' ).mask('000.000.000.000.000', {reverse: true});
</script>
@endsection

@stop
 