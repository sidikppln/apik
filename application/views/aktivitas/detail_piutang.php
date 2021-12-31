<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Aktivitas</h1>
        </div>
        <div class="col-sm-6">
        </div>
      </div>
  </section>

  <section class="content">

    <div class="row">
      <div class="col">
        <?php if ($this->session->flashdata('pesan')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> <?= $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-6">
                <a href="<?= base_url('aktivitas/index/2'); ?>" class="btn btn-sm btn-outline-info">Kembali</a>
                <a href="<?= base_url('aktivitas/update-piutang/') . $jenis_aktivitas . '/' . $id; ?>" class="btn btn-sm btn-outline-info ml-2">Ubah</a>
              </div>
              <div class="col-lg-6">
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover table-sm">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Uraian</th>
                  <th scope="col">Nominal</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1</td>
                  <td>Hak Penyerah Piutang</td>
                  <td class="text-right"><?= number_format($aktivitas['hak_pp'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td>BIAD PPN</td>
                  <td class="text-right"><?= number_format($aktivitas['biad_ppn'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td>Kelebihan</td>
                  <td class="text-right"><?= number_format($aktivitas['lebih'], 0, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>