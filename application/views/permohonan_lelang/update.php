<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <label for="">Nomor:</label>
                                <input type="text" name="nomor" class="form-control <?= form_error('nomor') ? 'is-invalid' : ''; ?>" value="<?= $permohonan_lelang['nomor']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nomor'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Tanggal:</label>
                                <input type="text" name="tanggal" class="form-control <?= form_error('tanggal') ? 'is-invalid' : ''; ?>" value="<?= date('d-m-Y', $permohonan_lelang['tanggal']); ?>" placeholder="dd-mm-YYYY">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama Pemohon:</label>
                                <input type="text" name="nama_pemohon" class="form-control <?= form_error('nama_pemohon') ? 'is-invalid' : ''; ?>" value="<?= $permohonan_lelang['nama_pemohon']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama_pemohon'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('contoh'); ?>" class="btn btn-sm btn-outline-info">Batal</a>
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