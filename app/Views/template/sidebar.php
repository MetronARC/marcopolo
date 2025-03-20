<aside class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
          <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AppDesk</span>
          </a>

          <ul class="sidebar-nav">
            <li class="sidebar-header">Pages / <?= session('type') ?></li>

            <?php foreach (session('access') as $key => $access) : ?>

              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= $access['path'] ?>">
                  <i class="align-middle" data-feather="<?= $access['icon'] ?>"></i>
                  <span class="align-middle"><?= $access['name'] ?></span>
                </a>
              </li>

            <?php endforeach ?>

          </ul>
        </div>
      </aside>