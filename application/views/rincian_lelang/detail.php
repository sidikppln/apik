<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rincian Lelang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Rincian Lelang</a></li>
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
                  <td class="text-right"><?= number_format($rincian_lelang['pokok'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td>Hasil Bersih Lelang untuk Pemohon Lelang</td>
                  <td class="text-right"><?= number_format($rincian_lelang['hasil_bersih'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td>Bea Lelang Pembeli</td>
                  <td class="text-right"><?= number_format($rincian_lelang['bea_pembeli'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">4</td>
                  <td>Bea Lelang Penjual</td>
                  <td class="text-right"><?= number_format($rincian_lelang['bea_penjual'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">5</td>
                  <td>Bea Lelang Batal</td>
                  <td class="text-right"><?= number_format($rincian_lelang['bea_batal'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">6</td>
                  <td>PPh Final</td>
                  <td class="text-right"><?= number_format($rincian_lelang['pph_final'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">7</td>
                  <td>Uang Jaminan Penawaran Lelang Pembeli Wanprestasi</td>
                  <td class="text-right"><?= number_format($rincian_lelang['ujl_wanprestasi'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">8</td>
                  <td>Jumlah Peserta Lelang</td>
                  <td class="text-right"><?= number_format($rincian_lelang['jml_peserta'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                  <td class="text-center">9</td>
                  <td>Uang Jaminan Penawaran Lelang</td>
                  <td class="text-right"><?= number_format($rincian_lelang['ujl'], 2, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>