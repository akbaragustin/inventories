
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>

<!--end-Footer-part-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ URL::asset('') }}plugins/js/excanvas.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/jquery.min.js"></script> 
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ URL::asset('') }}plugins/js/jquery.ui.custom.js"></script> 
<script src="{{ URL::asset('') }}plugins/js/bootstrap.min.js"></script> 
<script src="{{ URL::asset('') }}plugins/select2/js/select2.min.js"></script>
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
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
@yield('js')
</body>
</html>
