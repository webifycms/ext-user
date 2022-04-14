<?php

namespace OneCMS\User\Infrastructure;

use yii\base\Module as BaseModule;

/**
 * Class Module
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class Module extends BaseModule
{
    public $basePath = '@User';
    public $controllerNamespace = 'OneCMS\\User\\Infrastructure\\Presentation\\Admin\\Controller';

    public function init()
    {
        parent::init();
        $this->setViewPath('@User/templates');
    }
}