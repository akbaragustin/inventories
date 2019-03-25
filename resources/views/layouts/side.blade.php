
<!--sidebar-menu-->
<div id="sidebar"><a href="<?php echo url('/admin'); ?>" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="<?php echo url('/admin'); ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-group"></i> <span>Data Karyawan</span> <span class="label label-important"></span></a>
      <ul>
        <li><a href="<?php echo url('/admin/user'); ?>"><i class="icon icon-user"></i><span> Karyawan</span></a></li>
        <li><a href="<?php echo url('/admin/position'); ?>"><i class="icon icon-suitcase"></i><span> Jabatan</span></a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-sitemap"></i> <span>Data Inventaris</span> <span class="label label-important"></span></a>
      <ul>
        <li><a href="<?php echo url('/admin/goods'); ?>"><i class="icon icon-circle-arrow-down "></i><span> Bahan Makanan</span></a></li>
        <li><a href="<?php echo url('/admin/food'); ?>"><i class="icon icon-circle-arrow-down "></i><span> Makanan</span></a></li>
        <li><a href="<?php echo url('/admin/asset'); ?>"><i class="icon icon-briefcase"></i><span> Barang</span></a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-map-marker"></i> <span>Data Lokasi</span> <span class="label label-important"></span></a>
      <ul>
        <li><a href="<?php echo url('/admin/location'); ?>"><i class="icon icon-map-marker"></i><span>Lokasi</span></a></li>
        <li><a href="<?php echo url('/admin/location/goods'); ?>"><i class="icon-credit-card"></i><span> Bahan Makanan</span></a></li>   
      </ul>
    </li>
   
  </ul>
</div>
<!--sidebar-menu-->
