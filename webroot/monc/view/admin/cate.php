<?php
$model = new CateList();
?>
<div class="panel panel-default ani-body-list">
    <div class="panel-heading">
        <h3>类目</h3>
        <?php $this->renderPartial('_menu', array ('menu' => array (
            array ('创建', curl('cate/create'), 'plus'),
        ))); ?>
    </div>
    <div class="panel-body">
        <?
        $grid = new MGridView(array (
            'id' => 'grid-news',
            'model' => $model,
            'columns' => array (
                'cid',
                'title',
                'alias',
                'desc',
                'create_time',
                'update_time',
                'buttons' => array (
                    //'template' => '{view}, {update}, {delete}'
                    'view' => array (
                        'url' => 'url("/admin/cate/view", array("id"=>$data["primaryKey"]))',
                    ),
                    'update' => array (
                        'url' => 'curl("/admin/cate/update", array("id"=>$data["primaryKey"]))',
                    ),
                    'delete' => array (
                        'url' => 'curl("/admin/cate/delete", array("id"=>$data["primaryKey"]))',
                    ),
                ),
            ),
        ));
        echo $grid->render(); ?>
    </div>
</div>
