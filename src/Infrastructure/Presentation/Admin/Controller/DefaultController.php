<?php

namespace OneCMS\User\Infrastructure\Presentation\Admin\Controller;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}