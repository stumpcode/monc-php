<div class="text-center">
    <div class="" style="display:inline-block;">
        <div class="well well-light">
            <p>为了您的申请尽快通过审核，请如实填写，杭州动物保护协会不会透露您的个人资料</p>

            <p><font color="red">注</font><font color="#5e2cb0">：带“*”的为必选题</font></p>
        </div>

        <?php $form = new MActiveForm(); ?>
        <form action="" method="post" class="form-horizontal">
            <?= $form->errorSummary($model); ?>

            <?php echo $form->activeTextField($model, 'name'); ?>
            <?php echo $form->activeTextField($model, 'contact'); ?>
            <?php echo $form->activeTextField($model, 'home'); ?>
            <?php echo $form->activeTextField($model, 'id_num'); ?>

            <div class="" style="margin-left: 50px;">
                <button class="btn btn-next" type="submit">下一步</button>
            </div>

        </form>
    </div>
</div>
