<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Posts;
use common\models\User;
use yii\web\AccessControl;
use Yii;

/**
 * Site controller
 */
class SiteController extends BackendController {

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
        $users = User::find()->count('*');
        $materials = Posts::find()->count();
        return $this->render(
                        'index', ['users' => $users], ['materials' => $materials]
        );
    }

    public function actionStats() {
        $users = User::find();
        $materials = Posts::find();
        return $this->render('stats', [
                    'users' => $users,
                    'materials' => $materials,
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial(
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
