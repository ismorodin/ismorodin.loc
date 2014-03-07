<?php

namespace backend\controllers;

use backend\models\User;
use common\models\LoginForm;
use yii\web\AccessControl;
use Yii;

/**
 * Site controller
 */
class AdminController extends BackendController {

    /**
     * @inheritdoc
     */
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $users = User::find()->asArray()->all();
        $users = count($users);
        return $this->render(
                        'index', [
                    'users' => $users,
                        ]
        );
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render(
                            'login', [
                        'model' => $model,
                            ]
            );
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
