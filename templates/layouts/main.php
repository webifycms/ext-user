<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

use Webify\Base\Infrastructure\Component\View\WebViewComponent;
use Webify\User\Infrastructure\UserExtension;

/**
 * @var WebViewComponent $this
 * @var string           $content
 */
$iconUrl = UserExtension::getInstance()->getAssetsPublishedUrl() . '/icons/user.svg';
?>

<?php $this->beginContent('@Theme/templates/layouts/admin/main.php'); ?>

<div class="page-content-wrapper uk-padding-medium uk-animation-fade">
    <div class="page-content-header">
        <div class="uk-child-width-expand uk-flex-middle" uk-grid>
            <div>
                <div class="uk-flex uk-flex-middle">
                    <div class="header-icon uk-margin-small-right">
                        <img src="<?= $iconUrl; ?>" width="48" alt="">
                    </div>

                    <div class="header-title">
                        <h1 class="uk-text-large">User Management</h1>
                        <p class="uk-text-muted">User List</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-body">
        <?= $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>