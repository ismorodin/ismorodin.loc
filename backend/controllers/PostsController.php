<?php

/*
 * @author Ivan Smorodin
 */

namespace backend\controllers;

use common\models\Posts;
use common\models\Users;
use yii\data\Pagination;
use yii\helpers;
use yii\web\AccessControl;
use Yii;

/**
 * Posts Controller
 */
class PostsController extends BackendController {

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

//Load materials
    public function actionIndex() {
        $posts = Posts::find();
        $countPosts = clone $posts;
        $pages = new Pagination(['totalCount' => $countPosts->count()]);
        $models = $posts
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy(['id' => SORT_DESC,])
                ->all();
        return $this->render('index', [
                    'posts' => $models,
                    'pages' => $pages,
                        ]
        );
    }

//Update materials by ID
    public function actionUpdate($id) {
        $id = (int) intval(abs($id));
        if (isset($id)) {
            $model = Posts::find($id);
            if (isset($model)) {
                if ($model->load($_POST) && $model->save()) {
                    return $this->redirect(['posts/index', 'id' => $model->id]);
                } else {
                    return $this->render('update', [ 'model' => $model,]);
                }
            } else {
                $this->redirect('posts/index');
            }
        } else {
            $this->redirect('posts/index');
        }
    }

//Delete materials with param
    public function actionDelete($id) {
        if ($id === null) {
            $this->redirect(array('posts/index'));
        }
        $post = Posts::find($id);
        if ($post) {
            $post->delete();
            $this->redirect('posts/index');
        }
    }

//Add materials
    public function actionAdd() {
        $model = new Posts();
        $users = Users::find();
        if ($model->load($_POST)) {
            if ($model->validate()) {
                if ($model) {
                    $model->c_date = date('d-m-Y H:i:s');
                    $model->save();
                }
            }
            $this->redirect('posts/index');
        }
        return $this->render('add', [ 'model' => $model, 'user' => $users,]);
    }

}
