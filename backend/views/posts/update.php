<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
use mihaildev\ckeditor\CKEditor;
/**
 * @var yii\web\View $this
 * @var backend\models\Posts $model
 * @var ActiveForm $form
 */
$this->params['breadcrumbs'][]= 'Редактирование';
?>

<div class="posts-contacts">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->label('Название статьи'); ?>
		<?= $form->field($model,'content')->textarea()->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full',
                    'inline' => false,
                ]])->label('Контент')?>
        <?=$form->field($model, 'status')->dropDownList([1=>'Активный',0=>'Выключен'])->label('Доступ');?>
		<?= $form->field($model, 'm_date')->input('date')->label('Дата изменения'); ?>
		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
		</div>
	<?php ActiveForm::end(); ?>

</div><!-- posts-contacts -->
