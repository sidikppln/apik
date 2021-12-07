<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rincian Pengeluaran Lelang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Rincian Pengeluaran Lelang</a></li>
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
      <div class="col-lg-8">
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
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1</td>
                  <td>Pengembalian Uang Jaminan Penawaran Lelang</td>
                  <td class="text-right"><?= number_format(($rincian_lelang['jml_peserta'] - 1) * $rincian_lelang['ujl'], 2, ',', '.'); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('pengeluaran-lelang/pengembalian-ujl/') . $rincian_lelang['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Proses</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td>Pembayaran Hasil Bersih Lelang untuk Pemohon Lelang</td>
                  <td class="text-right"><?= number_format($rincian_lelang['hasil_bersih'], 2, ',', '.'); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('pengeluaran-lelang/hasil-bersih/') . $rincian_lelang['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Proses</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td>Pembayaran Bea Lelang Pembeli dan Penjual</td>
                  <td class="text-right"><?= number_format($rincian_lelang['bea_pembeli'] + $rincian_lelang['bea_penjual'], 2, ',', '.'); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('pengeluaran-lelang/bea-lelang/') . $rincian_lelang['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Proses</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">4</td>
                  <td>Pembayaran PPh Final</td>
                  <td class="text-right"><?= number_format($rincian_lelang['pph_final'], 2, ',', '.'); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('pengeluaran-lelang/pph-final/') . $rincian_lelang['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Proses</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">5</td>
                  <td>Penyetoran UJL Wanprestasi</td>
                  <td class="text-right"><?= number_format($rincian_lelang['ujl_wanprestasi'], 2, ',', '.'); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('pengeluaran-lelang/pph-final/') . $rincian_lelang['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Proses</a>
                    </div>
                  </td>
                </tr>
              </tbody>
              <?php $jumlah = (($rincian_lelang['jml_peserta'] - 1) * $rincian_lelang['ujl']) + $rincian_lelang['hasil_bersih'] + $rincian_lelang['bea_pembeli'] + $rincian_lelang['bea_penjual'] + $rincian_lelang['pph_final'] + $rincian_lelang['ujl_wanprestasi']; ?>
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col" class="text-center">Jumlah</th>
                  <th scope="col" class="text-right"><?= number_format($jumlah, 2, ',', '.'); ?></th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>