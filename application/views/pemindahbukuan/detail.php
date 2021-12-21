<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pemindahbukuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Pemindahbukuan</a></li>
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

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
          </div>
          <div class="col-lg-6">
            <?= form_open(); ?>
            <div class="input-group">
              <input type="text" name="name" class="form-control form-control-sm" placeholder="Nomor">
              <button class="btn btn-sm btn-outline-info" type="submit">Cari</button>
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
              <th scope="col">Nomor</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Jenis</th>
              <th scope="col">Debet</th>
              <th scope="col">Kredit</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            foreach ($nota as $r) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $r['nomor']; ?></td>
                <td><?= date('d-m-Y', $r['tanggal']); ?></td>
                <td><?= $r['nama_nota']; ?></td>
                <td><?= number_format($r['debet'], 0, ',', '.'); ?></td>
                <td><?= number_format($r['kredit'], 0, ',', '.'); ?></td>
                <td>
                  <div class="btn-group">
                    <?php if ($r['jenis_nota'] == 1) : ?>
                      <a href="<?= base_url('pemindahbukuan/transaksi-penerimaan/') . $jenis_aktivitas . '/' . $aktivitas_id . '/'  . $r['id']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0">Transaksi</a>
                    <?php else : ?>
                      <a href="<?= base_url('pemindahbukuan/transaksi-pengeluaran/') . $jenis_aktivitas . '/' . $aktivitas_id . '/'  . $r['id']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0">Transaksi</a>
                    <?php endif; ?>
                    <a href="<?= base_url('pemindahbukuan/proses/') . $jenis_aktivitas . '/' . $aktivitas_id  . '/' . $r['id'] . '/' . $r['jenis_nota']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan memproses data ini?');">Proses</a>
                    <a href="<?= base_url('pemindahbukuan/tolak/') . $jenis_aktivitas . '/' . $aktivitas_id  . '/' . $r['id'] . '/' . $r['jenis_nota']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan menolak data ini?');">Tolak</a>
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