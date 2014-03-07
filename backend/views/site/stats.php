<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\BaseHtml as BH;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = "{$title}";
?>
<div class="row">

	<div class="jumbotron">
		<h1>Статистика</h1>

		<p class="lead">Здесь вы можите просмотреть полную статистику сайта..</p>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="col-lg-4">
				<h2>Пользователи</h2>
				<a href="#">Зарегистрированные: <span class="badge"><?PHP ECHO $users->count() ?></span></a>
			</div>
			<div class="col-lg-4">
				<h2>Материалы:</h2>
				<strong>
					<?PHP ECHO BH::a(
								 "Всего материалов:" . " <span class='badge'>{$materials->count()}</span>",
									 'posts/index',
									 ['target' => "_blank", 'style' => 'color:red;','text-decoration:none,']
					)?>
				</strong>
				<br/>
				<?PHP ECHO BH::a("Активные:" . "<span class='badge'>{$materials->where(['status' => 1])->count()}</span>", 'posts/index', ['target' => "_blank"]) ?>
				<br/>

			</div>
			<div class="col-lg-4">
				<h2>Категории</h2>

				<p style="color:red;">В разработке!</p>

			</div>
		</div>

	</div>
</div>
