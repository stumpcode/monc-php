<div class="panel panel-default">
    <div class="panel-heading">
        <h3>创建<?= $this->cate->title ?></h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/' . $this->cate->alias)),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('../content/_form', array ('model' => $model)); ?>
    </div>
</div>
