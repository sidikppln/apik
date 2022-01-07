<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1>Penting Hari Ini</h1>
          <span class="text-secondary">Aktivitas dan transaksi yang harus dipantau agar dapat segera diselesaikan.</span>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Aktivitas</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('aktivitas'); ?>" class="text-dark">
                      <?= number_format($aktivitas, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Rekening Koran</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('verifikasi'); ?>" class="text-dark">
                      <?= number_format($rekening_koran, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>

            <div class=" clearfix hidden-md-up">
            </div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Verifikasi</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('verifikasi/index/1'); ?>" class="text-dark">
                      <?= number_format($penerimaan, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Nota Penerimaan</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('nota-penerimaan'); ?>" class="text-dark">
                      <?= number_format($nota_penerimaan, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Nota Pengeluaran</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('nota-pengeluaran'); ?>" class="text-dark">
                      <?= number_format($nota_pengeluaran, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Pengesahan</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('pengesahan'); ?>" class="text-dark">
                      <?= number_format($pengesahan, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>

            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Pemindahbukuan di Bank</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('pemindahbukuan'); ?>" class="text-dark">
                      <?= number_format($pemindahbukuan, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Pencatatan di Sakti</span>
                  <span class="info-box-number text-xl m-0">
                    <a href="<?= base_url('pencatatan'); ?>" class="text-dark">
                      <?= number_format($pencatatan, 0, ',', '.'); ?>
                    </a></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-2 mt-3">
            <div class="col">
              <h3 class="mb-0">Analisa Rekening</h3>
              <span class="text-secondary">Pembukuan bendahara dan posisi rekening penerimaan yang harus diperhatikan agar tetap seimbang.</span>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title text-bold p-1">Informasi rekening</h3>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-sm table-hover m-0">
                      <thead class="text-info">
                        <tr>
                          <th>Jenis</th>
                          <th>Debet</th>
                          <th>Kredit</th>
                          <th>Saldo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($kelompok as $r) : ?>
                          <tr>
                            <td><?= $r['nama']; ?></td>
                            <td><?= number_format($r['debet'], 0, ',', '.'); ?></td>
                            <td><?= number_format($r['kredit'], 0, ',', '.'); ?></td>
                            <td><?= number_format($r['debet'] - $r['kredit'], 0, ',', '.'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer clearfix">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title text-bold p-1"></i>Jumlah per aktivitas</h3>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-sm table-hover m-0">
                      <thead class="text-info">
                        <tr>
                          <th>Aktivitas</th>
                          <th>Debet</th>
                          <th>Kredit</th>
                          <th>Saldo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($jenis_aktivitas as $r) : ?>
                          <tr>
                            <td><?= $r['nama']; ?></td>
                            <td><?= number_format($r['debet'], 0, ',', '.'); ?></td>
                            <td><?= number_format($r['kredit'], 0, ',', '.'); ?></td>
                            <td><?= number_format($r['debet'] - $r['kredit'], 0, ',', '.'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer clearfix">
                </div>
              </div>
            </div>

          </div>

          <div class="row mt-3">
            <div class="col">
              <h3 class="mb-0">Arsip Transaksi</h3>
              <span class="text-secondary">10 transaksi terakhir Nota Penerimaan dan Nota Pengeluaran yang telah dilakukan pencatatan di Sakti.</span>
              <div class="card mt-2">
                <!-- <div class="card-header border-transparent">
                  <h3 class="card-title text-bold p-1">Informasi rekening</h3>
                </div> -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-sm table-hover m-0">
                      <thead class="text-info">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nomor</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Jenis</th>
                          <th scope="col">Debet</th>
                          <th scope="col">Kredit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($arsip as $r) : ?>
                          <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $r['nomor']; ?></td>
                            <td><?= date('d-m-Y', $r['tanggal']); ?></td>
                            <td><?= $r['nama_nota']; ?></td>
                            <td><?= number_format($r['debet'], 0, ',', '.'); ?></td>
                            <td><?= number_format($r['kredit'], 0, ',', '.'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer clearfix">
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-lg-3">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title text-bold pt-1 pb-1">Tugas yang belum diselesaikan</h3>
            </div>
            <div class="card-body m-0">
              <div class="callout callout-info">
                <h5>Verifikator</h5>
                <?php if ($rekening_koran > 0) : ?>
                  <p><i class="fas fa-exclamation-circle mr-1 text-warning"></i>Ada <?= number_format($rekening_koran, 0, ',', '.'); ?> transaksi yang belum dilakukan verifikasi.</p>
                <?php endif; ?>
                <?php if ($verifikasi > 0) : ?>
                  <p><i class="fas fa-exclamation-circle mr-1 text-warning"></i>Ada <?= number_format($verifikasi, 0, ',', '.'); ?> nota yang belum dikirim ke Otorisator.</p>
                <?php endif; ?>
              </div>
              <div class="callout callout-info">
                <h5>Otorisator</h5>
                <?php if ($pengesahan > 0) : ?>
                  <p><i class="fas fa-exclamation-circle mr-1 text-warning"></i>Ada <?= number_format($pengesahan, 0, ',', '.'); ?> nota yang belum dilakukan pengesahan.</p>
                <?php endif; ?>
              </div>
              <div class="callout callout-info">
                <h5>Bendahara Penerimaan</h5>
                <?php if ($pemindahbukuan > 0) : ?>
                  <p><i class="fas fa-exclamation-circle mr-1 text-warning"></i>Ada <?= number_format($pemindahbukuan, 0, ',', '.'); ?> nota yang belum dilakukan pemindahbukuan.</p>
                <?php endif; ?>
                <?php if ($pencatatan > 0) : ?>
                  <p><i class="fas fa-exclamation-circle mr-1 text-warning"></i>Ada <?= number_format($pencatatan, 0, ',', '.'); ?> nota yang belum dilakukan pencatatan di Sakti.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>





    </div>
  </section>
</div>