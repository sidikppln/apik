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
                        <li class="breadcrumb-item active">Impor CSV</li>
                    </ol>
                </div>
            </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">

                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group mb-2">
                                <label for="">File CSV:</label>
                                <input type="file" name="file_csv" class="form-control <?= form_error('file_csv') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('file_csv'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('rekening-koran'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
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