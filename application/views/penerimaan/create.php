<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Penerimaan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Penerimaan</a></li>
            <li class="breadcrumb-item active">Create</li>
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
              <th scope="col">Tanggal</th>
              <th scope="col">Kode</th>
              <th scope="col">Nominal</th>
              <th scope="col">Virtual Account</th>
              <th scope="col">Kode Lelang</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            foreach ($penerimaan as $r) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= date('d-m-Y', $r['tanggal']); ?></td>
                <td><?= $r['kdsatker'] . '.' . $r['tahun'] . '.' . $r['kode_kelompok'] . '.' . $r['kode_jenis'] . '.' . $r['kode_sub_jenis'] . '.' . $r['no_urut']; ?></td>
                <td class="text-right"><?= number_format($r['kredit'], 2, ',', '.'); ?></td>
                <td><?= $r['virtual_account']; ?></td>
                <td><?= $r['kode_lelang']; ?></td>
                <td>
                  <a href="<?= base_url('penerimaan/pilih/') . $r['id'] . '/' . $nota_penerimaan_id; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0">Pilih</a>
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