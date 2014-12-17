<?php
$model = new ContentList($cate);
?>
<div class="panel panel-default ani-body-list">
    <div class="panel-heading">
        <h3><?= $cate->title ?></h3>
        <?php $this->renderPartial('_menu', array ('menu' => array (
            array ('创建', curl('content/create', array ('cid' => $cate->cid)), 'plus'),
        ))); ?>
    </div>
    <div class="panel-body">
        <?
        $grid = new MGridView(array (
            'id' => 'grid-news',
            'model' => $model,
            'columns' => array (
                'content_id',
                'uid',
                'title',
                array ('image', 'type' => 'image50'),
                'alias',
                'create_time',
                'update_time',
                'status',
                'buttons' => array (
                    'view' => array (
                        'url' => 'url("/admin/content/view", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                    'update' => array (
                        'url' => 'curl("/admin/content/update", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                    'delete' => array (
                        'url' => 'curl("/admin/content/delete", array("id"=>$data["primaryKey"], "cid"=>$data["cid"]))',
                    ),
                ),
            ),
        ));
        echo $grid->render(); ?>
    </div>
</div>
