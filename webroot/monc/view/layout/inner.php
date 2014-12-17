<?php $this->wrap('layout/main') ?>
<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked" style="margin-bottom: 10px;">
        <?php $arr = array (
            array (url('/adopt'), '等待领养'),
            array (url('/live'), '等待寄居'),
            array (url('/donate'), '等待捐助'),
            array (url('/form'), '申请表格'),
            array (url('/medic'), '医疗救助'),
            array (url('/news'), '新闻动态'),
        );
        foreach ($arr as $one) {
            list($uri, $title) = $one;
            $active = $uri == $this->request->uri ? true : false;
            ?>
            <li class="<?= $active ? 'active' : '' ?>">
                <a href="<?= $uri ?>"><?= $title ?><i
                        class="glyphicon glyphicon-play pull-right"></i></a></li>
        <? } ?>
    </ul>

    <div class="panel panel-light">
        <div class="panel-body">
            <ul class="list-unstyled">
                <?
                $list = app()->cms->aliasList(null, null, 5);
                foreach ($list as $one) {
                    ?>
                    <li>
                        <a href="<?= curl('/page/index',
                            array ('id' => $one->content_id)); ?>"><?= $one->title ?></a>
                    </li>
                <? } ?>
            </ul>
        </div>
    </div>

</div>
<div class="col-sm-9">
    <?= $content ?>
</div>
<?php $this->endWrap() ?>
