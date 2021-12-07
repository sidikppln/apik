<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rincian Piutang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rincian Piutang</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                                <input type="text" name="kode" class="form-control <?= form_error('kode') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kode'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama:</label>
                                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Hak Penyerah Piutang:</label>
                                <input type="text" name="hak_pp" class="form-control <?= form_error('hak_pp') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('hak_pp'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">BIAD PPN:</label>
                                <input type="text" name="biad_ppn" class="form-control <?= form_error('biad_ppn') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('biad_ppn'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kelebihan:</label>
                                <input type="text" name="lebih" class="form-control <?= form_error('lebih') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('lebih'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('rincian-piutang'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
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