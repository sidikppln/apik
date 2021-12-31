<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0-rc
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

</div>

<script src="<?= base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>asset/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>asset/js/adminlte.min.js"></script>
<script>
  $('.form-check-penerimaan').on('click', function() {
    const nota_penerimaan_id = $(this).data('nota');
    const id = $(this).data('id');
    $.ajax({
      url: "<?= base_url('nota-penerimaan/pilih-transaksi-ujl'); ?>",
      type: 'post',
      data: {
        nota_penerimaan_id: nota_penerimaan_id,
        id: id
      },
      success: function() {}
    });
  });
</script>

</body>

</html>