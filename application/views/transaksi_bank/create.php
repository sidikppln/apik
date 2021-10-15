<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contoh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Contoh</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">

                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group mb-2">
                                <label for="">Nomor:</label>
                                <input type="text" name="nomor" class="form-control <?= form_error('nomor') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nomor'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Nama:</label>
                                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <a href="<?= base_url('contoh'); ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary ml-1">Simpan</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->