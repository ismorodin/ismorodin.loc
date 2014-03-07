<?php

/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 26.02.14
 * Time: 13:20
 */

namespace backend\controllers;

use yii;
use yii\web\Controller;

class BackendController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
