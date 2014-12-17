<div class="panel panel-default ani-body-list">
    <div class="panel-heading">
        <ol class="breadcrumb">
            <li>您所在的位置：</li>
            <li><a href="#">首页</a></li>
            <li><a href="#">新闻动态</a></li>
        </ol>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <?
            $pagination = new MPagination();
            $arr = Content::model()
                ->findAll('delete_time is null', array (), $pagination, 'content_id desc');
            !$arr && $arr = array();
            foreach ($arr as $one) {
                $link = curl('page', array ('id' => $one->content_id));
                ?>
                <li class="ani-list-item">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= $one->image ?>" style="max-width: 160px;">
                        </div>
                        <div class="col-sm-9">
                            <div class="heading row">
                                <h3 class="title col-sm-6">
                                    <?= $one->title ?>
                                </h3>
                                    <span class="control col-sm-6">
                                        <span
                                            class="pull-right">[<?=
                                            app()->formatter->format('date',
                                                $one->create_time) ?>]</span>
                                    </span>
                            </div>
                            <div class="body">
                                <?=
                                app()->formatter->format('contentPreview',
                                    $one->content, array ('limit' => '100')) ?>
                                <a class='pull-right' href="<?= $link ?>">查看更多</a>
                            </div>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
        <?php
        $pager = MPager::getInstance(array (
            'pagination' => $pagination
        ));

        echo $pager->render(); ?>
    </div>
</div>
