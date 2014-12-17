<?php $form = new MActiveForm() ?>
<div class="centered" style="width: 500px;">

    <form class="form-horizontal" method="post">

        <h2 class="form-signin-heading">登陆</h2>

        <?= $form->errorSummary($model); ?>

        <?php echo $form->activeTextField($model, 'name', array ('placeholder' => '用户名')); ?>
        <?php echo $form->activePasswordField($model, 'password', array ('placeholder' => '密码')); ?>

        <div class="clearfix"><br/></div>
        <div class="col-sm-offset-2" style="">
            <button class="btn btn-large btn-primary " type="submit">登陆</button>
        </div>

    </form>
</div>
