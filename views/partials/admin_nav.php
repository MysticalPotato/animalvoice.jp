<div class="sidebar">
    <div class="sidebar-top">
        <div class="sidebar-header">
            <span>Admin</span>
        </div>
        
        <?php if(isset($_SESSION['user'])) : ?>

            <div class="nav-btn-container">
                <a id="groups-btn" class="nav-btn <?= $current_tab === 'groups' ? 'active' : '' ?>" href="<?= route('/admin/groups') ?>" attr="groups">
                    <img src="<?= PATH['images'] ?>admin-icon-location.png"/>
                    <span><?= __('nav.groups') ?></span>
                </a>
                
                <?php if($_SESSION['user']['admin']) : ?>
                    <a id="users-btn" class="nav-btn <?= $current_tab === 'users' ? 'active' : '' ?>" href="<?= route('/admin/users') ?>" attr="users">
                        <img src="<?= PATH['images'] ?>admin-icon-user.png"/>
                        <span><?= __('nav.users') ?></span>
                    </a>
                <?php endif; ?>

                <a id="applications-btn" class="nav-btn <?= $current_tab === 'applications' ? 'active' : '' ?>" href="<?= route('/admin/applications') ?>" attr="applications">
                    <img src="<?= PATH['images'] ?>admin-icon-spark.png"/>
                    <span><?= __('nav.applications') ?></span>
                </a>

                <a id="posts-btn" class="nav-btn <?= $current_tab === 'posts' ? 'active' : '' ?>" href="<?= route('/admin/posts') ?>" attr="posts">
                    <img src="<?= PATH['images'] ?>admin-icon-instagram.png"/>
                    <span><?= __('nav.posts') ?></span>
                </a>
                
                <a id="newsletter-btn" class="nav-btn <?= $current_tab === 'subscribers' ? 'active' : '' ?>" href="<?= route('/admin/subscribers') ?>" attr="newsletter">
                    <img src="<?= PATH['images'] ?>admin-icon-envelope.png"/>
                    <span><?= __('nav.subscribers') ?></span>
                </a>

                <a id="settings-btn" class="nav-btn <?= $current_tab === 'settings' ? 'active' : '' ?>" href="<?= route('/admin/settings') ?>" attr="settings">
                    <img src="<?= PATH['images'] ?>admin-icon-gear.png"/>
                    <span><?= __('nav.settings') ?></span>
                </a>
            </div>

        <?php endif; ?>
    </div>

    <div class="sidebar-bottom">
        <?php if(isset($_SESSION['user'])) : ?>

        <div class="nav-btn-container">
            <form class="logout-btn" method="POST" action="<?= route('/sessions') ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button class="nav-btn">
                    <img src="<?= PATH['images'] ?>admin-icon-power.png"/>
                    <span><?= __('nav.logout') ?></span>
                </button>
            </form>
        </div>
        
        <?php endif; ?>
    </div>
</div>