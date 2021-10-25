<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url(); ?>" class="brand-link">
      <img src="<?= base_url(); ?>asset/img/apik.png" alt="Apik Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">APIK</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>asset/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- untuk menampilkan menu -->
          <?php
          $menu = $this->menu_m->get();
          foreach ($menu as $m) :
          ?>
            <li class="nav-header"><?= $m['name']; ?></li>

            <!-- untuk menampilkan sub_menu -->
            <?php
            $sub_menu = $this->sub_menu_m->getSubMenu($m['id']);
            foreach ($sub_menu as $sm) :
              $sub_sub_menu = $this->sub_sub_menu_m->getSubSubMenu($sm['id']);
            ?>
              <li class="nav-item">
                <a href="<?= $sm['url']; ?>" class="nav-link">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <p><?= $sm['name']; ?> <?= $sub_sub_menu ? '<i class="right fas fa-angle-left"></i>' : ''; ?></p>
                </a>

                <!-- untuk menampilkan sub_sub_menu -->
                <?php if ($sub_sub_menu) : ?>
                  <ul class="nav nav-treeview">
                    <?php foreach ($sub_sub_menu as $ssm) :
                      $sub_sub_sub_menu = $this->sub_sub_sub_menu_m->getSubSubSubMenu($ssm['id']);
                    ?>
                      <li class="nav-item">
                        <a href="<?= $ssm['url']; ?>" class="nav-link">
                          <i class="<?= $ssm['icon']; ?>"></i>
                          <p><?= $ssm['name']; ?> <?= $sub_sub_sub_menu ? '<i class="right fas fa-angle-left"></i>' : ''; ?></p>
                          </p>
                        </a>

                        <!-- untuk menampilkan sub_sub_menu -->
                        <?php if ($sub_sub_sub_menu) : ?>
                          <ul class="nav nav-treeview">
                            <?php foreach ($sub_sub_sub_menu as $sssm) : ?>
                              <li class="nav-item">
                                <a href="<?= $sssm['url']; ?>" class="nav-link">
                                  <i class="<?= $sssm['icon']; ?>"></i>
                                  <p><?= $sssm['name']; ?></p>
                                </a>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          <?php endforeach; ?>

        </ul>
      </nav>
    </div>
  </aside>