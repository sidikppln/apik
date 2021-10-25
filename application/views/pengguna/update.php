<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Pengguna</a></li>
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
                                <label for="">NIP:</label>
                                <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>" value="<?= $pengguna['nip']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nip'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama:</label>
                                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= $pengguna['nama']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" value="<?= $pengguna['password']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('password'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Is Active:</label>
                                <input type="text" name="is_active" class="form-control <?= form_error('is_active') ? 'is-invalid' : ''; ?>" value="<?= $pengguna['is_active']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('is_active'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('pengguna'); ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary ml-1">Simpan</button>
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