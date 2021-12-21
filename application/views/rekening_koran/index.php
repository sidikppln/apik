<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rekening Koran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Rekening Koran</li>
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
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-8">
                <a href="<?= base_url('rekening-koran/import/'); ?>" class="btn btn-sm btn-outline-info ml-1">Impor CSV</a>
                <span style="width: 0px; height: 100px; border: 1px #BFC5CD solid;" class="ml-2 mr-2">
                </span>
                <?php foreach ($ref_bank as $r) : ?>
                  <a href="<?= base_url('rekening-koran/index/') . $r['kode']; ?>" class="btn btn-sm btn-outline-info ml-1 <?= $kode_bank == $r['kode'] ? 'active' : ''; ?>"><?= $r['nama']; ?></a>
                <?php endforeach; ?>
              </div>
              <div class="col-lg-4">
                <form action="" method="post" autocomplete="off">
                  <div class="input-group">
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama">
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
                  <th scope="col">Tanggal Transaksi</th>
                  <th scope="col">Jumlah Debet</th>
                  <th scope="col">Jumlah Kredit</th>
                  <th scope="col">Jumlah Transaksi</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $page + 1;
                foreach ($view_rekening_koran as $r) : ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $r['tanggal'] . '-' . $r['bulan'] . '-20' . $r['tahun']; ?></td>
                    <td><?= $r['debet']; ?></td>
                    <td><?= $r['kredit']; ?></td>
                    <td><?= $r['jumlah']; ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url('rekening-koran/detail/') . $r['tanggal'] . '-' . $r['bulan'] . '-' . $r['tahun'] . '/' . $r['kode_bank']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0">Detail</a>
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
      </div>
    </div>

  </section>
</div>