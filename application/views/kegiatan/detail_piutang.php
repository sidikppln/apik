<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kegiatan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
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
                <a href="<?= base_url('kegiatan/update-piutang/') . $jenis . '/' . $id; ?>" class="btn btn-sm btn-outline-info">Ubah</a>
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
                  <td class="text-right"><?= number_format($kegiatan['hak_pp'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td>BIAD PPN</td>
                  <td class="text-right"><?= number_format($kegiatan['biad_ppn'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td>Kelebihan</td>
                  <td class="text-right"><?= number_format($kegiatan['lebih'], 0, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>