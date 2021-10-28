<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Role</a></li>
                        <li class="breadcrumb-item"><a href="#">Akses</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
    </section>

    <section class="content">

        <div class="row">
            <div class="col">
                <?php if ($this->session->flashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> <?= $this->session->flashdata('pesan'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" autocomplete="off">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $page + 1;
                        foreach ($sub_sub_menu as $r) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $r['name']; ?></td>
                                <td>
                                    <a href="<?= base_url('akses/pilih/') . $r['id'] . '/' . $role_id; ?>" class="btn btn-sm btn-outline-success">Pilih</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <?= $name == null ? $pagination : ''; ?>
            </div>
        </div>

    </section>
</div>