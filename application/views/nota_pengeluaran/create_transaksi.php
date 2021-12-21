<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nota Pengeluaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nota Pengeluaran</a></li>
                        <li class="breadcrumb-item active">Tambah Transaksi</li>
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
                    <div class="col-lg-6">
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
                            <a href="<?= base_url('nota-pengeluaran/transaksi/') . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_pengeluaran_id . '/' . $kode_nota; ?>" class="btn btn-sm btn-outline-info">Batal</a>
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