<!-- Bootstrap v4.6 -->
<script src="{{ mix('js/app.js') }}"></script>

<!-- DataTables v.1.10.24 + Responsive v.2.2.7 + Button v.1.6.5 + Select v1.3 (BS v.4.1 Integration)-->
<script src="{{ asset('assets/plugin/DataTables-1.10.24/datatables.min.js') }}"></script>

<!-- Bootstrap 4 Datepicker -->
<script src="{{ asset('assets/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Bootstrap 4 Select Plugin v.1.13.14 -->
<script src="{{ asset('assets/plugin/bootstrap-select-1.13.14/js/bootstrap-select.min.js') }}"></script>

<!-- Fontawesome v5.11.2-->
<script src="{{ asset('assets/plugin/fontawesome/all.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>
  // let statusEnableSidebar = @json(Cookie::get('enable_sidebar'));
  $("#switchNavbar").on("click", function(){
      $(this).parent().parent().submit();
  });
  
  //tutup sidebar, ketika user mengklik tombol silang
  $(".closebtn").on("click", function(){
    $("#sidebar").css('width', '0');
    $("main").css('margin-left', '0px');
    $(".navbar-toggler").css('display', 'inline-block');
  });

  $(".navbar-toggler").on("click", function(){
    $("#sidebar").css('width', '260px');
    if(!navigator.userAgent.toLowerCase().match('mobile')){
      $("main").css('margin-left', '260px');
    }
  });

  $('#collapseManajemenUser').on('show.bs.collapse', function () {
    $(".bi-chevron-right").css('transform', 'rotate(90deg)');
  })

  $('#collapseManajemenUser').on('hide.bs.collapse', function () {
    $(".bi-chevron-right").css('transform', 'rotate(0deg)');
  })
</script>