<div class="panel panel-default">
    <div class="panel-heading">
        <h3>编辑</h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/cate')),
            array ('创建', url('/admin/cate/create')),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array ('model' => $model)); ?>
    </div>
</div>
