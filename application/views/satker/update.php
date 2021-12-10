<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Referensi Satker</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Referensi Satker</a></li>
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
                                <input type="text" name="kdsatker" class="form-control <?= form_error('kdsatker') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['kdsatker']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kdsatker'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama Satker:</label>
                                <input type="text" name="nmsatker" class="form-control <?= form_error('nmsatker') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['nmsatker']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nmsatker'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">No Urut Penerimaan:</label>
                                <input type="text" name="no_urut_penerimaan" class="form-control <?= form_error('no_urut_penerimaan') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['no_urut_penerimaan']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('no_urut_penerimaan'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">No Nota Penerimaan:</label>
                                <input type="text" name="no_nota_penerimaan" class="form-control <?= form_error('no_nota_penerimaan') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['no_nota_penerimaan']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('no_nota_penerimaan'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">No Urut Pengeluaran:</label>
                                <input type="text" name="no_urut_pengeluaran" class="form-control <?= form_error('no_urut_pengeluaran') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['no_urut_pengeluaran']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('no_urut_pengeluaran'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">No Nota Pengeluaran:</label>
                                <input type="text" name="no_nota_pengeluaran" class="form-control <?= form_error('no_nota_pengeluaran') ? 'is-invalid' : ''; ?>" value="<?= $ref_satker['no_nota_pengeluaran']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('no_nota_pengeluaran'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('satker'); ?>" class="btn btn-sm btn-outline-info">Batal</a>
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