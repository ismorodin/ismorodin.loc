<?php
use backend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<?= $this->registerMetaTag(['encoding' => 'utf-8']); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
	<?php
	NavBar::begin(
		  [
			  'options' => [
				  'class' => 'navbar navbar-default navbar-fixed-top',
			  ],
		  ]
	);
	$menuItems = [
		['label' => 'Система', 'url' => ['/site/index']],
		['label' => 'Пользователи', 'url' => ['/site/index']],
		['label' => 'Меню', 'url' => ['/site/index']],
		['label' => 'Материалы', 'url' => ['/posts/index']],
		['label' => 'Компоненты', 'url' => ['/site/index']],
		['label' => 'Расширения', 'url' => ['/site/index']],
		['label' => 'Справка', 'url' => ['/site/index']],
	];
	if (Yii::$app->user->isGuest) {
		$menuItems[] = ['label' => 'Login', 'url' => ['/admin/login']];
	} else {
		$menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/admin/logout']];
	}
	echo Nav::widget(
			[
				'options' => ['class' => 'navbar-nav navbar-left'],
				'items' => $menuItems,
			]
	);
	NavBar::end();
	?>

	<div class="container">

		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<?=
		Breadcrumbs::widget(
				   [
					   'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : ['Панель Управления'],
				   ]
		) ?>
	</div>
	<div class="container">
		<p class="pull-left">&copy; Ivan Smorodin <?= date('Y') ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
