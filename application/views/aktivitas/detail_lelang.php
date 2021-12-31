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
                <a href="<?= base_url('aktivitas/index/1'); ?>" class="btn btn-sm btn-outline-info">Kembali</a>
                <a href="<?= base_url('aktivitas/update-lelang/') . $jenis_aktivitas . '/' . $id; ?>" class="btn btn-sm btn-outline-info ml-2">Ubah</a>
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
                  <td>Pokok Lelang</td>
                  <td class="text-right"><?= number_format($aktivitas['pokok'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td>Hasil Bersih Lelang untuk Pemohon Lelang</td>
                  <td class="text-right"><?= number_format($aktivitas['hasil_bersih'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td>Bea Lelang Pembeli</td>
                  <td class="text-right"><?= number_format($aktivitas['bea_pembeli'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">4</td>
                  <td>Bea Lelang Penjual</td>
                  <td class="text-right"><?= number_format($aktivitas['bea_penjual'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">5</td>
                  <td>Bea Lelang Batal</td>
                  <td class="text-right"><?= number_format($aktivitas['bea_batal'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">6</td>
                  <td>PPh Final</td>
                  <td class="text-right"><?= number_format($aktivitas['pph_final'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">7</td>
                  <td>Uang Jaminan Penawaran Lelang Pembeli Wanprestasi</td>
                  <td class="text-right"><?= number_format($aktivitas['ujl_wanprestasi'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">8</td>
                  <td>Jumlah Peserta Lelang</td>
                  <td class="text-right"><?= number_format($aktivitas['jml_peserta'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">9</td>
                  <td>Uang Jaminan Penawaran Lelang</td>
                  <td class="text-right"><?= number_format($aktivitas['ujl'], 0, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>