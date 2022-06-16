<?php

namespace OneCMS\User\Infrastructure;

use yii\base\Module;

/**
 * Class UserModule
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class UserModule extends Module
{
    public $basePath = '@User';

    public $layout = 'main';

    public $controllerNamespace = 'OneCMS\\User\\Infrastructure\\Presentation\\Admin\\Controller';

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        parent::init();
        $this->setViewPath('@User/templates');
    }
}
