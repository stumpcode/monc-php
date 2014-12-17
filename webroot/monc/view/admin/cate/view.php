<div class="panel panel-default">
    <div class="panel-heading">
        <h3>编辑</h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/cate')),
            array ('创建', url('/admin/cate/create')),
            array ('编辑',
                url('/admin/cate/update', array ('id' => $model->cid))),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php
        $view = new ModelView(array (
            'model' => $model,
        ));
        echo $view->render();
        ?>
    </div>
</div>
