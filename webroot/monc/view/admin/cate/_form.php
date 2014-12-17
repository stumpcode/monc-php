<?php $form = new MActiveForm(); ?>
<form action="" method="post" class="form-horizontal">

    <?= $form->errorSummary($model); ?>

    <?php echo $form->activeTextField($model, 'title'); ?>
    <?php echo $form->activeTextField($model, 'alias'); ?>
    <?php echo $form->activeTextField($model, 'desc'); ?>

    <div class="col-sm-offset-2">
        <button class="btn btn-primary" type="submit">下一步</button>
    </div>
</form>
