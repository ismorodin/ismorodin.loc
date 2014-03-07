<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Posts;
use common\models\User;
use yii\web\AccessControl;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class TwigController extends BackendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $title = 'Hello Twig!';
        return $this->renderPartial(
                        'index.twig', ['title' => $title]);
    }

}
