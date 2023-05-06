<?php

namespace Webify\User\Infrastructure\Presentation\Admin\Controller;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}