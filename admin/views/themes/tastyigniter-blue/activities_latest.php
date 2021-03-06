<ul class="menu activities-list">
    <?php if ($activities) {?>
        <?php foreach ($activities as $activity) { ?>
            <li class="<?php echo $activity['state']; ?>">
                <div class="clearfix">
                    <span class="activity-body"><i class="<?php echo $activity['icon']; ?> fa-fw"></i>
                        <span class="small text-muted"><?php echo $activity['time']; ?>&nbsp;-&nbsp;</span>
                        <?php echo $activity['message']; ?>
                    </span>
                    <span class="activity-time text-muted text-right small"><?php echo $activity['time_elapsed']; ?></span>
                </div>
            </li>
            <li class="divider"></li>
        <?php } ?>
    <?php } else { ?>
        <li><?php echo lang('text_empty'); ?></li>
        <li class="divider"></li>
    <?php } ?>
</ul>
