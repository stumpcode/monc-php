<?php $this->wrap('layout/main'); ?>

    <?php $this->renderPartial('_step') ?>
    <div class="panel panel-default ">
        <div class="panel-body form-panel">
            <?= $content ?>
        </div>
    </div>
<?php $this->endWrap();?>
