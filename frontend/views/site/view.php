<?php

/**
 * @var yii\web\View $this
 */
use yii\helpers\BaseHtmlPurifier as clear;
use yii\widgets\ActiveForm;

$clr = function ($data) {
	return clear::process($data, [
		'Attr.EnableID' => true,
		'HTML.AllowedElements' => array
		(
			'strong' => true,
			'em' => true,
			'ul' => true,
			'ol' => true,
			'li' => true,
			'img' => true,
			'a' => true,
			'p' => true,
			'span' => true,
		),
	]);
}
?>
<style>
	.content {
		font-family: 'tahoma';
		padding: 5px 0 0 25px;
		font-size: 20px;
	}

	.date, .author {
		font-size: 0.9em;
	}

	.comments {
		margin: 0px 0 5px 20px;
	}

	.header_comments {
		font-size: 0.9em;
	}

	.blockquote {
		margin: 10px;
	}
</style>
<?PHP foreach ($posts as $post): ?>
<?PHP $this->title = clear::process($post['title']) ?>
<?PHP $this->registerMetaTag(['description' => clear::process($post['descriptions'])]); ?>
<?PHP $this->registerMetaTag(['keywords' => clear::process($post['keywords'])]); ?>
<div class="row">
	<?
	$this->params['breadcrumbs'][] = $this->title;?>
	<div class="row">
		<span class="author"><kbd><?PHP ECHO clear::process($post['c_date']); ?></kbd></span>
		<span class="date"><kbd><?PHP ECHO clear::process($post['m_date']); ?></kbd></span>
		<span class="date"><kbd><?PHP ECHO clear::process($post['user']['username']); ?></kbd></span>

		<div class="page-header">
			<h1 style="font-weight: 300;padding: 30px;"><?PHP ECHO clear::process($post['title']); ?></h1>

			<div class="panel-body">
				<span class="content"> <?PHP ECHO nl2br($clr($post['content'])); ?></span><br/>
			</div>
		</div>
		<?PHP endforeach ?>
		<div class="form-group">
			<?php
			/**
			 * Comments form
			 */
			$form = ActiveForm::begin([
				'id' => 'login-form',
				'options' => ['class' => 'form-horizontal', 'style' => 'width:400px;'],
			]);?>
			<?PHP ECHO $form->field($model, 'title')->label('Заголовок'); ?>
			<?PHP ECHO $form->field($model, 'comment')->textarea()->label('Комментарий'); ?>
			<div class="form-group">
				<div class="col-lg-offset-1 col-lg-11">
					<?PHP ECHO \yii\helpers\Html::submitButton('Добавить комментарий', ['class' => 'btn btn-primary']) ?>
				</div>
			</div>
			<?PHP ActiveForm::end() ?>
			<?PHP /**END FORM */ ?>
		</div>
		<hr>
		<?PHP
		/**
		 * Pagination
		 */
		ECHO \yii\widgets\LinkPager::widget([
			'pagination' => $pages,
			'options' => [
				'class' => 'pagination pagination-sm',
			],
			'class' => 'pagination pagination-lg',
			'activePageCssClass' => 'active',
			'nextPageLabel' => '<span class="glyphicon glyphicon-share-alt">',
			'prevPageLabel' => '<span class="glyphicon glyphicon-arrow-left">'
		]);?>
		<h2>Комментарии:</h2><br/>
		<? /**
		 * ALL COMMENTS
		 */
		?>
		<? foreach ($comments as $comment): ?>
			<div class="comments">
				<span class="comments_author"><kbd><?PHP ECHO $comment['title']; ?></kbd></span>
				<span class="comments_author"><kbd><?PHP ECHO $comment['id']; ?></kbd></span>
				<span class="comments_author"><kbd><?PHP ECHO $comment['user']['username']; ?></kbd></span>

				<div class="well well-sm" style="margin-top:10px;"><?PHP ECHO $comment['comment']; ?></div>
			</div>
		<? endforeach ?>
	</div>
	<br/>
</div>


