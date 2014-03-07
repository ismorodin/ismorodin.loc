<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Posts;
use common\models\Users;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\web\AccessControl::className(),
				'only' => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{
		$query = Posts::find()->where(['status' => 1]);
                //$users = Users::find()->limit(3)->where(['in', 'id', [1, 2, 3]])->asArray()->all();
                //var_dump($users);
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$models = $query
			->offset($pages->offset)
			->limit($pages->limit)
			->with('user')
			->orderBy(['id' => SORT_DESC,])
			->asArray()
			->all();
		return $this->render(
					'index', [
							'posts' => $models,
							'pages' => $pages,
						]
		);
	}

	public function actionView($id)
	{
		$id = intval($id);
		if (is_integer($id)) {
			$posts = Posts::find()
						  ->where(['id' => $id])
						  ->with('user')
						  ->asArray()
						  ->all();
		} else {
			$this->redirect('site/index');
		}
		return $this->render(
					'view', [
							'posts' => isset($posts) ? $posts : null,
						]
		);
	}

	public function actionTest()
	{
		return $this->renderPartial('Hello world!');
	}

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			$this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render(
						'login', [
								'model' => $model,
							]
			);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm;
		if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash(
							  'success', 'Thank you for contacting us. We will respond to you as soon as possible.'
			);
			return $this->refresh();
		} else {
			return $this->render(
						'contact', [
								'model' => $model,
							]
			);
		}
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())) {
			$user = $model->signup();
			if ($user) {
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}

		return $this->render(
					'signup', [
							'model' => $model,
						]
		);
	}

	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($model->sendEmail()) {
				Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
				return $this->goHome();
			} else {
				Yii::$app->getSession()->setFlash(
						 'error', 'Sorry, we are unable to reset password for email provided.'
				);
			}
		}

		return $this->render(
					'requestPasswordResetToken', [
							'model' => $model,
						]
		);
	}

	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load($_POST) && $model->resetPassword()) {
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');
			return $this->goHome();
		}

		return $this->render(
					'resetPassword', [
							'model' => $model,
						]
		);
	}
}