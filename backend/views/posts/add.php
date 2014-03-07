<?PHP
use kartik\widgets\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Posts $model
 * @var ActiveForm $form
 */
?>
<?php
$this->params['breadcrumbs'][] = 'Добавление материала';
$form = ActiveForm::begin(
				  [
					  'id' => 'add_materials',
					  'errorCssClass' => 'has-error has-feedback',

				  ]
); ?>

<div class="row">
	<div class="form-group">
		<?PHP ECHO $form->field($model, 'title')->label('Заголовок'); ?>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Материал</a></li>
			<li><a href="#options" data-toggle="tab">Параметры публикации</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="home"><br/>
				<?PHP ECHO $form->field($model, 'status')->dropDownList([1 => 'Активный', 0 => 'Выключен'])->label(
								'Доступ'
				);?>
				<?PHP ECHO $form->field($model, 'user_id')->widget(Select2::classname(), [
					'data' => \yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
					'options' => ['placeholder' => 'Выберите пользователя...'],
					'language' => 'Ru',
					'pluginOptions' => [
						'allowClear' => true
					],
				]);?>
				<?PHP ECHO $form->field($model, 'content')->textarea()->widget(
								CKEditor::className(), [
										'editorOptions' => [
											'preset' => 'full',
											'inline' => false,
										],
									]
				)->label('Контент')?>
			</div>

			<div class="tab-pane" id="options"><br/>
				<?PHP ECHO $form->field($model, 'descriptions')->textarea(['class' => 'form-control'])->label('Мета-тег Description'); ?>
				<?PHP ECHO $form->field($model, 'keywords')->textarea(['class' => 'form-control'])->label('Мета-тег Keywords'); ?>
			</div>
		</div>
		<?= Html::submitButton('Добавить материал', ['class' => 'btn-group btn-group-midle']) ?>
		<?php ActiveForm::end(); ?>
	</div>
	<script>
		$(function () {
			$('#myTab a:last').tab('show')
		})
	</script>