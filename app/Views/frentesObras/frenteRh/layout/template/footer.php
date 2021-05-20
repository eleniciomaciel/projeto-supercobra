
  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url() ?>/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>/plugins/select2/js/select2.full.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url() ?>/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url() ?>/dist/js/pages/dashboard.js"></script>
  <!-- InputMask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- moment js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/x.y.z/locale/ar.js"></script>

  
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
      $('.select2EstadoCivil').select2({
        theme: 'bootstrap4'
      });
      $('.select2GrauInstrucai').select2({
        theme: 'bootstrap4'
      });
      $('.select2Nacionalidade').select2({
        theme: 'bootstrap4'
      });
      $('.select2Estados').select2({
        theme: 'bootstrap4'
      });
      $('.select2EmissorRG').select2({
        theme: 'bootstrap4'
      });
      $('.select2EmissorRG2').select2({
        theme: 'bootstrap4',
      });
      $('.select2TituloUf').select2({
        theme: 'bootstrap4',
      });
      $('.select2CTPScategoria').select2({
        theme: 'bootstrap4',
      });
      $('.select2TamanhoRoupa').select2({
        theme: 'bootstrap4',
      });
      $('.select2Calca').select2({
        theme: 'bootstrap4',
      });
      $('.select2Sangue').select2({
        theme: 'bootstrap4',
      });
      $('.select2UfCTPS').select2({
        theme: 'bootstrap4',
      });
      $('.select2FuncaoTodas').select2({
        theme: 'bootstrap4',
      });
      $('.select2CargoTrocaFuncaoTodas').select2({
        theme: 'bootstrap4',
      });
      $('.select2DepartamentosTodas').select2({
        theme: 'bootstrap4',
      });
      //mask
      $('#add_colab_cep_moradia').mask("00.000-000", {
        placeholder: "00.000-000"
      });
      $('#add_colab_cpf_numero').mask("000.000.00-00", {
        placeholder: "000.000.00-00"
      });
    });
  </script>
  <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/popups/001_popups_funcao') ?>
  <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/popups/002_popups_cargo') ?>
  <?= $this->include('frentesObras/frenteRh/layout/components/001_popap_departamentos') ?>
  <!-- popups -->
  <!-- js -->
  <?= $this->include('frentesObras/frenteRh/layout/js/001_viacep') ?>
  <?= $this->include('frentesObras/frenteRh/layout/js/002_funcao') ?>
  <?= $this->include('frentesObras/frenteRh/layout/js/003_departamento') ?>

</body>

</html>