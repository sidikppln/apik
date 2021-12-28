<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Role</a></li>
                        <li class="breadcrumb-item active">Update</li>
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
                                <label for="">Nama:</label>
                                <input type="text" name="name" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" value="<?= $role['name']; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('name'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('role'); ?>" class="btn btn-sm btn-outline-info">Batal</a>
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