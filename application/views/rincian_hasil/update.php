<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rincian Hasil Lelang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rincian Hasil Lelang</a></li>
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
                                <label for="">Kode Lelang:</label>
                                <input type="text" name="kode" class="form-control <?= form_error('kode') ? 'is-invalid' : ''; ?>" value="<?= $lelang['kode']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kode'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama Lelang:</label>
                                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= $lelang['nama']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">PNBP:</label>
                                <input type="text" name="pnbp" class="form-control <?= form_error('pnbp') ? 'is-invalid' : ''; ?>" value="<?= $lelang['pnbp']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('pnbp'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">PPh:</label>
                                <input type="text" name="pph" class="form-control <?= form_error('pph') ? 'is-invalid' : ''; ?>" value="<?= $lelang['pph']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('pph'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Hasil Bersih:</label>
                                <input type="text" name="bersih" class="form-control <?= form_error('bersih') ? 'is-invalid' : ''; ?>" value="<?= $lelang['bersih']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('bersih'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('rincian-hasil'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
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