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
                                <label for="">Pokok Lelang:</label>
                                <input type="text" name="pokok" class="form-control <?= form_error('pokok') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('pokok'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Hasil Bersih Lelang Untuk Pemohon Lelang:</label>
                                <input type="text" name="hasil_bersih" class="form-control <?= form_error('hasil_bersih') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('hasil_bersih'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Bea Lelang Pembeli:</label>
                                <input type="text" name="bea_pembeli" class="form-control <?= form_error('bea_pembeli') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('bea_pembeli'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Bea Lelang Penjual:</label>
                                <input type="text" name="bea_penjual" class="form-control <?= form_error('bea_penjual') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('bea_penjual'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Bea Lelang Batal:</label>
                                <input type="text" name="bea_batal" class="form-control <?= form_error('bea_batal') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('bea_batal'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">PPh Final:</label>
                                <input type="text" name="pph_final" class="form-control <?= form_error('pph_final') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('pph_final'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">UJL Wanprestasi:</label>
                                <input type="text" name="ujl_wanprestasi" class="form-control <?= form_error('ujl_wanprestasi') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ujl_wanprestasi'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Jumlah Peserta:</label>
                                <input type="text" name="jml_peserta" class="form-control <?= form_error('jml_peserta') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('jml_peserta'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nilai UJL:</label>
                                <input type="text" name="ujl" class="form-control <?= form_error('ujl') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ujl'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('rincian-lelang'); ?>" class="btn btn-sm btn-outline-success">Batal</a>
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