<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Referensi Nota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Referensi Nota</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
                    </ol>
                </div>
            </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">

                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group mb-2">
                                <label for="">Kode:</label>
                                <input type="text" name="kode" class="form-control <?= form_error('kode') ? 'is-invalid' : ''; ?>" value="<?= $nota['kode']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kode'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama:</label>
                                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= $nota['nama']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kode Kelompok:</label>
                                <input type="text" name="kode_kelompok" class="form-control <?= form_error('kode_kelompok') ? 'is-invalid' : ''; ?>" value="<?= $nota['kode_kelompok']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kode_kelompok'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kode Jenis:</label>
                                <input type="text" name="kode_jenis" class="form-control <?= form_error('kode_jenis') ? 'is-invalid' : ''; ?>" value="<?= $nota['kode_jenis']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kode_jenis'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Status:</label>
                                <input type="text" name="status" class="form-control <?= form_error('status') ? 'is-invalid' : ''; ?>" value="<?= $nota['status']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('status'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('nota'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-success ml-1">Simpan</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="card-footer">
            </div>
        </div>

    </section>
</div>