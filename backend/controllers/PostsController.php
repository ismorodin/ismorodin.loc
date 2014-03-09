<?PHP

namespace backend\controllers;

use common\models\Posts;
use common\models\Users;
use yii\data\Pagination;
use yii\helpers;
use yii\web\AccessControl;
use Yii;

/**
 * PostsController
 *
 * PostController need to work with the material site
 * @author Ivan Smorodin <ismorodin@hotmail.com>
 * @since 2.0
 * @name PostController
 * @see common\models\Posts;
 * @see common\models\Users;
 */
class PostsController extends BackendController {

    /**
     * @return array
     */
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

    /**
     * All posts
     * 
     * displays all the posts from the model \common\models\Posts
     * @return \yii\base\View index
     * @see \common\models\Posts
     * */
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

    /**
     * Update posts by ID
     * 
     * Need for updated news by id
     * @param integer $id - id news from DB
     * @return \yii\base\View index
     * @see \common\models\Posts
     */
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

    /**
     * Delete posts by ID
     * 
     * Delete posts by ID from the model [[\common\models\Posts.]]
     * @param int $id - pk id from models [common\models\Posts]
     * @return \yii\base\View index
     * @see \common\models\Posts
     */
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

    /**
     * Add posts
     * 
     * Add posts in the model [[\common\models\Posts]]
     * @return \yii\base\View index
     * @see \common\models\Posts
     */
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
