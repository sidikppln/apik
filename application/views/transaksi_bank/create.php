<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi Bank</a></li>
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
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="">Tanggal:</label>
                                <input type="text" name="tanggal" class="form-control <?= form_error('tanggal') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Uraian:</label>
                                <input type="text" name="uraian" class="form-control <?= form_error('uraian') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('uraian'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Debet:</label>
                                <input type="text" name="debet" class="form-control <?= form_error('debet') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('debet'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kredit:</label>
                                <input type="text" name="kredit" class="form-control <?= form_error('kredit') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kredit'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('transaksi-bank'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
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