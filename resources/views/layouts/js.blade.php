  <!-- jQuery -->


    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    {{-- <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script> --}}
    <!-- NProgress -->
    {{-- <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script> --}}
    <!-- bootstrap-progressbar -->
    {{-- <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> --}}
    <!-- iCheck -->
    {{-- <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script> --}}

    <!-- bootstrap-daterangepicker -->
    {{-- <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}

    <!-- iCheck -->
    {{-- <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script> --}}
    <!-- Datatables -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script> --}}

    <script src="{{ asset('ps://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js') }}"></script>

    <!-- ECharts -->
    {{-- <script src="{{ asset('vendors/echarts/dist/echarts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/echarts/map/js/world.js') }}"></script> --}}

    <!-- Switchery -->
    {{-- <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script> --}}

    <!-- Select2 -->
    {{-- <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script> --}}
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('build/js/chart.js') }}"></script>
    <script src="{{ asset('build/js/custom.js') }}"></script>

    {{-- <script src="{{ asset('etalert2.all.min.js') }}"></script> --}}



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `هل تريد حذف هذا السجل بالفعل ؟`,
              text: "في حالة الموافقة لا يمكنك التراجع عن هذا الاجراء !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
                ButtonColor: "#1cc88a",

              buttons: [ 'إلغاء ',' ! نعم ,   حذف السجل ']
            //   buttons: [' ! نعم ,   حذف السجل ', 'إلغاء ']
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

      $(document).ready(function() {
            $('.select_2').select2();
        });
</script>

<script type="text/javascript">

     $('.show_confirm2').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `هل تريد إلغاء التسليم بالفعل ؟`,
            //   text: "في حالة الموافقة لا يمكنك التراجع عن هذا الاجراء !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
                ButtonColor: "#1cc88a",

              buttons: [ 'إلغاء ',' ! نعم ,    إلغاء التسليم ']

          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });


</script>


<script type="text/javascript">

     $('.show_confirm_item').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `هل تريد إلغاء الطلب بالفعل ؟`,
              text: "في حالة الموافقة لا يمكنك التراجع عن هذا الاجراء !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
                ButtonColor: "#1cc88a",

              buttons: [ 'إلغاء ',' ! نعم ,    إلغاء الطلب ']

          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });


</script>



<script type="text/javascript">

     $('.show_confirm_ref').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `هل تريد تحديث اسعار البيع بالفعل ؟`,
              text: "في حالة الموافقة لا يمكنك التراجع عن هذا الاجراء وسيتم تحديث كل السعار !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              ButtonColor:'#1cc88a',

              buttons: [ 'إلغاء ',' ! نعم ,    حدث الأسعار ']
            //   buttons: [' ! نعم ,   حذف السجل ', 'إلغاء ']
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

<script type="text/javascript">

     $('.show_confirm_all').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `هل تريد حذف  الفاتورة بالفعل  ؟`,
              text: "في حالة الموافقة لا يمكنك التراجع عن هذا الاجراء وسيتم حذف كل المشتريات المتعلقة بالفاتورة !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              ButtonColor:'#1cc88a',

              buttons: [ 'إلغاء ',' ! نعم ,    حذف الفاتورة  ']
            //   buttons: [' ! نعم ,   حذف السجل ', 'إلغاء ']
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@livewireScripts


