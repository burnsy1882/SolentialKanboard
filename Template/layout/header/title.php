<?php global $themeSolentialConfig; ?>
    <span class="logo">
        <?= $this->url->link('<img src="'.$themeSolentialConfig['logo'].'" style="float: left; max-height: 40px; margin-top: -5px; margin-right: 10px;" />', 'DashboardController', 'show', array(), false, '', t('Dashboard')) ?>
    </span>
    <h1>
        <span class="title">
            <?php if (! empty($project) && ! empty($task)): ?>
                <?= $this->url->link($this->text->e($project['name']), 'BoardViewController', 'show', array('project_id' => $project['id'])) ?>
            <?php else: ?>
                <?= $this->text->e($title) ?>
                <?php if (! empty($project) && $project['task_limit'] && array_key_exists('nb_active_tasks', $project)): ?>
                  (<span><?= intval($project['nb_active_tasks']) ?></span> / <span title="<?= t('Task limit') ?>"><span class="ui-helper-hidden-accessible"><?= t('Task limit') ?> </span><?= $this->text->e($project['task_limit']) ?></span>)
                <?php endif ?>
            <?php endif ?>
        </span>
        <?php if (! empty($description)): ?>
            <?= $this->app->tooltipHTML($description) ?>
        <?php endif ?>
        <span class="separator">
            |
        </span>
        <span class="date">
            <?php echo date("l, F j, Y, g:i A"); ?>
        </span>
    </h1>