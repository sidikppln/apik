<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Sub Sub Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Menu</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Sub Menu</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Sub Sub Menu</a></li>
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
                                <label for="">Nama:</label>
                                <input type="text" name="name" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('name'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">URL:</label>
                                <input type="text" name="url" class="form-control <?= form_error('url') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('url'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Icon:</label>
                                <input type="text" name="icon" class="form-control <?= form_error('icon') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('icon'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Urutan:</label>
                                <input type="text" name="urutan" class="form-control <?= form_error('urutan') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('urutan'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('sub-sub-sub-menu/index/') . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id; ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
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