<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                                <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nip'); ?>
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
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('password'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Role:</label>
                                <select class="form-control" name="role_id">
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id']; ?>"><?= $r['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Kode Satker:</label>
                                <select class="form-control" name="kdsatker">
                                    <?php foreach ($ref_satker as $r) : ?>
                                        <option value="<?= $r['kdsatker']; ?>"><?= $r['nmsatker']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('user'); ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
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