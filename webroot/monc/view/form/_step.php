<?php $step = substr($this->action->id, -1); ?>
<div class="text-center step-wrapper">

    <div class="step">
        <ul class="list-unstyled">
            <li class="<?= $step == 1 ? 'active' : '' ?>">
                <div>
                    <?php if ($step > 1) { ?>
                        <a href="<?= curl('step1') ?>">
                            <span class="icon-oval">1</span>
                        </a>
                    <? } else { ?>
                        <span class="icon-oval">1</span>
                    <? } ?>
                </div>
                <h3>
                    声明条款
                </h3>
            </li>
            <li><span class="icon-arrow"></li>
            <li class="<?= $step == 2 ? 'active' : '' ?>">
                <div>
                    <?php if ($step > 2) { ?>
                        <a href="<?= curl('step2') ?>">
                            <span class="icon-oval">2</span>
                        </a>
                    <? } else { ?>
                        <span class="icon-oval">2</span>
                    <? } ?>
                </div>
                <h3>
                    填写基本资料
                </h3>
            </li>
            <li><span class="icon-arrow"></li>
            <li class="<?= $step == 3 ? 'active' : '' ?>">
                <div class="">
                    <?php if ($step > 3) { ?>
                        <a href="<?= curl('step3') ?>">
                            <span class="icon-oval">3</span>
                        </a>
                    <? } else { ?>
                        <span class="icon-oval">3</span>
                    <? } ?>
                </div>
                <h3>
                    领养申请
                </h3>
            </li>
            <li><span class="icon-arrow"></li>
            <li class="<?= $step == 4 ? 'active' : '' ?>">
                <div class="">
                <span class="icon-oval icon-oval-ok">
                    <i class="glyphicon glyphicon-ok"></i></span>
                </div>
                <h3>
                    完成
                </h3>
            </li>
        </ul>
    </div>
</div>
