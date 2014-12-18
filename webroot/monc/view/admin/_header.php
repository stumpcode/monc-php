<div class="container">
    <div class="navbar-header">
        <a href="../" class="navbar-brand"
           style="font-size: 22px;line-height: 30px;">
            monc-php</a>
    </div>
    <? if ($this->user->id) { ?>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= url('/admin/manage') ?>">首页管理</a>
                </li>
                <li>
                    <a href="<?= url('/admin/news') ?>">新闻</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= url('/admin/cate') ?>">分类</a>
                </li>
            </ul>
        </nav>
    <? } ?>
</div>
