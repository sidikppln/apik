<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pencatatan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Pencatatan</li>
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
            <?php foreach ($ref_jenis_aktivitas as $r) : ?>
              <a href="<?= base_url('pencatatan/index/') . $r['kode']; ?>" class="btn btn-sm btn-outline-info ml-1 <?= $jenis_aktivitas == $r['kode'] ? 'active' : ''; ?>"><?= $r['nama']; ?></a>
            <?php endforeach; ?>
          </div>
          <div class="col-lg-6">
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
        <div class="row mb-2">
          <div class="col">

          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table table-bordered table-hover table-sm">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Nomor</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $page + 1;
                foreach ($aktivitas as $r) : ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $r['kode']; ?></td>
                    <td><?= $r['nama']; ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url('pencatatan/detail/') . $jenis_aktivitas . '/' . $r['id']; ?>" class="btn btn-sm btn-outline-info pt-0 pb-0">Detail</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>