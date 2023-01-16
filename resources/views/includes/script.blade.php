
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- jQuery -->
<script src="{{ URL::asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
{{-- <script src="{{ URL::asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('backend/plugins/sparklines/sparkline.js') }}"></script> --}}
<!-- JQVMap -->
{{-- <script src="{{ URL::asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ URL::asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('backend/js/adminlte.js') }}"></script>

<script src="{{ URL::asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ URL::asset('backend/js/adminlte.js') }}"></script>
<script src="{{ URL::asset('plugins/retina/retina.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ URL::asset('backend/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ URL::asset('backend/js/pages/dashboard.js') }}"></script> --}}
<script>
  var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
  var currentTheme = localStorage.getItem('theme');
  var mainHeader = document.querySelector('.main-header');
  var sideBar = document.querySelector('.main-sidebar');

  if (currentTheme) {
    if (currentTheme === 'dark') {
      if (!document.body.classList.contains('dark-mode')) {
        document.body.classList.add("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-light')) {
        mainHeader.classList.add('navbar-dark');
        mainHeader.classList.remove('navbar-light');
      }
      if(sideBar.classList.contains('sidebar-light-success')){
        sideBar.classList.add('sidebar-dark-success');
        sideBar.classList.remove('sidebar-light-success');
      }
      toggleSwitch.checked = true;
    }
  }

  function switchTheme(e) {
    if (e.target.checked) {
      if (!document.body.classList.contains('dark-mode')) {
        document.body.classList.add("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-light')) {
        mainHeader.classList.add('navbar-dark');
        mainHeader.classList.remove('navbar-light');
      }
      if(sideBar.classList.contains('sidebar-light-success')){
        sideBar.classList.add('sidebar-dark-success');
        sideBar.classList.remove('sidebar-light-success');
      }
      localStorage.setItem('theme', 'dark');
    } else {
      if (document.body.classList.contains('dark-mode')) {
        document.body.classList.remove("dark-mode");
      }
      if (mainHeader.classList.contains('navbar-dark')) {
        mainHeader.classList.add('navbar-light');
        mainHeader.classList.remove('navbar-dark');
      }
      if(sideBar.classList.contains('sidebar-dark-success')){
        sideBar.classList.add('sidebar-light-success');
        sideBar.classList.remove('sidebar-dark-success');
      }
      localStorage.setItem('theme', 'light');
    }
  }

  toggleSwitch.addEventListener('change', switchTheme, false);

  $('#id_department').change(function(){
    var idDept = $(this).val();    
    if(idDept){
        $.ajax({
           type:"GET",
           url:"/getrelevant?id_department="+idDept,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#id_part").empty();
                $("#id_part").append('<option>---Select Here---</option>');
                $.each(res,function(nama,kode){
                    $("#id_part").append('<option value="'+kode+'">'+nama+'</option>');
                });
            }else{
               $("#id_part").empty();
            }
           }
        });
    }else{
        $("#id_part").empty();
    }      
   });

  //  display image
  $(document).ready(function (e) {
 
  $('#table-month').DataTable();

  $('#table-list').DataTable();
   
 $('#image').change(function(){
          
  let reader = new FileReader();

  reader.onload = (e) => { 

    $('#preview-image-before-upload').attr('src', e.target.result); 
  }

  reader.readAsDataURL(this.files[0]); 
 
 });
 
});
   
</script>