<ul class="list-unstyled list-menu clearfix">
    <?php
    if ($menu) {
        foreach ($menu as $one) {
            $one = array_merge($one, array (null, null, null));
            list($label, $link, $icon) = $one;
            ?>
            <li class="clearfix">
                <a href="<?= $link ?>">
                    <?= $icon ? "<i class='glyphicon glyphicon-{$icon}'></i>" : '' ?>
                    <?= $label ?>
                </a>
            </li>
        <?
        }
    }?>
</ul>
