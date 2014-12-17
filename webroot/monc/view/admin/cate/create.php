<div class="panel panel-default">
    <div class="panel-heading">
        <h3>创建类目</h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/cate')),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model'=>$model));?>
    </div>
</div>
