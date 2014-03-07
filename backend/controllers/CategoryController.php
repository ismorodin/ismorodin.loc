<?php

/*
 * @author Ivan Smorodin
 */

namespace backend\controllers;

use common\models\Category;
use yii\web\AccessControl;
use yii\widgets;
use Yii;

/**
 * Posts Controller
 */
class CategoryController extends BackendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'add', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate() {
        $model = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (($data = Yii::app()->getRequest()->getPost('Category')) !== null) {

            $model->setAttributes($data);

            if ($model->save()) {

                Yii::app()->user->setFlash(
                        YFlashMessages::SUCCESS_MESSAGE, Yii::t('CategoryModule.category', 'Record was created!')
                );

                $this->redirect(
                        (array) Yii::app()->getRequest()->getPost(
                                'submit-type', array('create')
                        )
                );
            }
        }

        $languages = $this->yupe->getLanguagesList();

        //если добавляем перевод
        $id = (int) Yii::app()->getRequest()->getQuery('id');
        $lang = Yii::app()->getRequest()->getQuery('lang');

        if (!empty($id) && !empty($lang)) {
            $category = Category::model()->findByPk($id);

            if (null === $category) {
                Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::ERROR_MESSAGE, Yii::t('CategoryModule.category', 'Targeting category was not found!')
                );
                $this->redirect(array('create'));
            }

            if (!array_key_exists($lang, $languages)) {
                Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::ERROR_MESSAGE, Yii::t('CategoryModule.category', 'Language was not found!')
                );

                $this->redirect(array('create'));
            }

            Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE, Yii::t(
                            'CategoryModule.category', 'You are adding translate in to {lang}!', array(
                        '{lang}' => $languages[$lang]
                            )
                    )
            );

            $model->lang = $lang;
            $model->alias = $category->alias;
            $model->parent_id = $category->parent_id;
            $model->name = $category->name;
        } else {
            $model->lang = Yii::app()->language;
        }

        $this->render('create', array('model' => $model, 'languages' => $languages));
    }

}
