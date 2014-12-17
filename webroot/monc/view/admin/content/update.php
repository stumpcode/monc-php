<div class="panel panel-default">
    <div class="panel-heading">
        <h3>编辑</h3>
        <?php $this->renderPartial('../_menu', array ('menu' => array (
            array ('列表', url('/admin/' . $this->cate->alias)),
            array ('创建', url('/admin/content/create', array ('cid'=>$this->cate->cid))),
        ))); ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('../content/_form', array ('model' => $model)); ?>
    </div>
</div>
