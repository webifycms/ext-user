<?php view()->beginContent('@Admin/templates/layouts/main.php'); ?>

<?= view()->render('_sidebarNav') ?>

<header class="grid gap-4 grid-flow-col auto-cols-max place-items-center mb-3">
    <div>
        <svg width="50" height="50" fill="currentColor">
            <use xlink:href="<?= view()->theme->baseUrl . '/images/icons.svg#person' ?>" />
        </svg>
    </div>
    <div>
        <h1 class="text-xl font-semibold"><?= translate('user', 'User Management') ?></h1>
        <p class="text-mute text-base"><?= translate('user', 'You can manage your users here.') ?></p>
    </div>
</header>

<?= $content ?>

<?php view()->endContent(); ?>