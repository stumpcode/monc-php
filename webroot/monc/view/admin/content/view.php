<div class="panel panel-default">
    <div class="panel-heading">
        <h3>编辑</h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/' . $this->cate->alias)),
            array ('创建', url('/admin/content/create', array ('cid'=>$this->cate->cid))),
            array ('编辑',
                url('/admin/content/update', array ('id' => $model->content_id, 'cid'=>$this->cate->cid))),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php
        $view = new ModelView(array (
            'model' => $model,
            'columns' => array (
                'title',
                'alias',
                'create_time',
                array ('status', 'type' => 'status'),
                array ('image', 'type' => 'image50'),
                array ('content', 'type' => 'dbhtml'),
            )
        ));
        echo $view->render();
        ?>
    </div>
</div>
