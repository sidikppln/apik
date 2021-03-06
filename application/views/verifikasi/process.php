<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Verifikasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Verifikasi</a></li>
                        <li class="breadcrumb-item active">Proses</li>
                    </ol>
                </div>
            </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">

                <?= form_open(); ?>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group mb-2">
                            <label for="">Uraian:</label>
                            <textarea name="" id="" cols="30" rows="2" class="form-control" disabled><?= $verifikasi_penerimaan['uraian']; ?></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Nomor Virtual Account:</label>
                            <input type="text" name="virtual_account" class="form-control <?= form_error('virtual_account') ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= form_error('virtual_account'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Jenis Transaksi:</label>
                            <select class="form-control" name="kode">
                                <?php foreach ($view_jenis as $r) : ?>
                                    <option value="<?= $r['kode_kelompok'] . $r['kode_jenis']; ?>"><?= $r['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <a href="<?= base_url('verifikasi/index/0'); ?>" class="btn btn-sm btn-outline-info">Batal</a>
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