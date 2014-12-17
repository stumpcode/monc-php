<?php $form = new MActiveForm(); ?>
<div id="form3" class="wrapper">

    <form action="" method="post" class="form-horizontal">

        <div class="heading">
            <div class="inner">
                <p class="line1">每当你从宠物店买走一只小动物，就意味着有一只流浪猫狗可能失去温暖的家。</p>

                <p class="line2">
                    <i class="micon-heart"></i>
                    <i class="micon-heart"></i>
                    <i class="micon-heart"></i>
                    请一定要仔细填写领养资料噢
                    <i class="micon-heart"></i>
                    <i class="micon-heart"></i>
                    <i class="micon-heart"></i>
                </p>
            </div>
        </div>

        <?= $form->errorSummary($model); ?>
        <?php echo $form->activeRadioList($model, 'pet_type', array (
            '猫' => '猫',
            '狗' => '狗',
            '均可' => '均可',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_sex', array (
            1 => '公',
            2 => '母',
            3 => '均可'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_now', array (
            1 => '是',
            2 => '否',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_now_cnt', array (
            1 => '1只',
            2 => '2-4只',
            3 => '5只以上'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_now_type', array (
            1 => '猫',
            2 => '狗',
            3 => '其他'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_adult', array (
            1 => '是',
            2 => '否',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_disability', array (
            1 => '是',
            2 => '否',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'pet_sterilize', array (
            1 => '是',
            2 => '否',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>

        <div class="line-bar">
            &nbsp;
        </div>


        <?php echo $form->activeRadioList($model, 'sex', array (
            1 => '男',
            2 => '女',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'job', array (
            1 => '学生',
            2 => '工作',
            3 => '退休',
            3 => '其他'
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'living', array (
            1 => '租房',
            2 => '宿舍合住',
            2 => '自由住房',
            3 => '和家人住'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'home_idea', array (
            1 => '赞成',
            2 => '反对',
            3 => '无所谓'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'when_pregnant', array (
            1 => '寄养',
            2 => '送走',
            3 => '留下来继续养'), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>
        <?php echo $form->activeRadioList($model, 'ok_return_visit', array (
            1 => '接受',
            2 => '不接受',
        ), array ('labelOptions' => array ('class' => 'col-sm-4 text-right'),
            'controlOptions' => array ('class' => 'col-sm-7'))); ?>

        <div class="text-center" style="margin-top: 300px;">
            <button class="btn btn-next" type="submit">下一步</button>
        </div>
        <div class="footer">
            <div class="inner">
                <p class="line1">谢谢你填写了申请信息。<br/>最后，请你郑重承诺，绝不遗弃我！</p>
            </div>
        </div>

    </form>
</div>
