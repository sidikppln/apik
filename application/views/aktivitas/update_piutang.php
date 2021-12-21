<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Detail</a></li>
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
                                <label for="">Hak Penyerah Piutang:</label>
                                <input type="text" name="hak_pp" class="form-control <?= form_error('hak_pp') ? 'is-invalid' : ''; ?>" value="<?= $aktivitas['hak_pp']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('hak_pp'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">BIAD PPN:</label>
                                <input type="text" name="biad_ppn" class="form-control <?= form_error('biad_ppn') ? 'is-invalid' : ''; ?>" value="<?= $aktivitas['biad_ppn']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('biad_ppn'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kelebihan:</label>
                                <input type="text" name="lebih" class="form-control <?= form_error('lebih') ? 'is-invalid' : ''; ?>" value="<?= $aktivitas['lebih']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('lebih'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('aktivitas/detail/') . $jenis . '/' . $id; ?>" class="btn btn-sm btn-outline-info">Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-info ml-1">Simpan</button>
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