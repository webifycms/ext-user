<?php view()->beginBlock('sidebarNav'); ?>
<a href="<?= url(['list']) ?>" class="text-center">
    <svg class="block mx-auto w-6 h-6 xl:w-8 xl:h-8" width="32" height="32" fill="currentColor">
        <use xlink:href="<?= view()->theme->baseUrl . '/images/icons.svg#person' ?>" />
    </svg>
    <span class="block mt-2 mx-auto"><?= translate('user', 'Persons') ?></span>
</a>
<?php view()->endBlock(); ?>