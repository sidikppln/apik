<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rincian Hasil Lelang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Rincian Hasil Lelang</li>
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

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <a href="<?= base_url('rincian-hasil/create/'); ?>" class="btn btn-sm btn-outline-success">Tambah</a>
          </div>
          <div class="col-lg-6">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama">
                <button class="btn btn-sm btn-outline-success" type="submit">Cari</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama</th>
              <th scope="col">UJL</th>
              <th scope="col">Pelunasan</th>
              <th scope="col">Hasil Lelang</th>
              <th scope="col">PNBP</th>
              <th scope="col">PPh</th>
              <th scope="col">Hasil Bersih</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            foreach ($lelang as $r) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $r['kode']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td class="text-right"><?= number_format($r['jaminan'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['pelunasan'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['jaminan'] + $r['pelunasan'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['pnbp'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['pph'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['bersih'], 0, ',', '.'); ?></td>
                <td class="text-right"><?= number_format($r['pnbp'] + $r['pph'] + $r['bersih'], 0, ',', '.'); ?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?= base_url('penerimaan/show/') . $r['id'] . '/121'; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Detail</a>
                    <a href="<?= base_url('rincian-hasil/update/') . $r['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Ubah</a>
                    <a href="<?= base_url('rincian-hasil/delete/') . $r['id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>