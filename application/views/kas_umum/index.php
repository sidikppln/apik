<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kas Umum</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Kas Umum</li>
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
              <th scope="col">Uraian</th>
              <th scope="col">Debet</th>
              <th scope="col">Kredit</th>
              <th scope="col">Saldo</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            $s_awal = 0;
            $s_akhir = 0;
            foreach ($kas_umum as $r) : $s_akhir = $s_awal + ($r['kredit'] - $r['debet']); ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= date('d-m-Y h:i:s', $r['tanggal']); ?></td>
                <td><?= $r['kdsatker'] . '.' . $r['tahun'] . '.' . $r['kode_kelompok'] . '.' . $r['kode_jenis'] . '.' . $r['kode_sub_jenis'] . '.' . $r['no_urut']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td><?= number_format($r['debet'], 0, ',', '.'); ?></td>
                <td><?= number_format($r['kredit'], 0, ',', '.'); ?></td>
                <td><?= number_format($s_akhir, 0, ',', '.'); ?></td>
              </tr>
            <?php
              $s_awal = $s_akhir;
            endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>