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
            $arr = array (1, 1, 1, 1, 1);
            foreach ($arr as $one) {
                $link = '';
                ?>
                <li class="ani-list-item">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= Html::res('image/banner.jpg') ?>">
                        </div>
                        <div class="col-sm-9">
                            <div class="heading row">
                                <h3 class="title col-sm-6">
                                    泰迪走丢了
                                </h3>
                                    <span class="control col-sm-6">
                                        <span class="pull-right">[2014-01-01]</span>
                                    </span>
                            </div>
                            <div class="body">
                                泰迪是藏獒的最爱，他们的小激情生活会很美满哦。
                                <a class='pull-right' href="<?= $link ?>">查看更多</a>
                            </div>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
        <?php
        $pagination = new MPagination(100);
        $pager = MPager::getInstance(array (
            'pagination' => $pagination
        ));

        echo $pager->render(); ?>
    </div>
</div>
