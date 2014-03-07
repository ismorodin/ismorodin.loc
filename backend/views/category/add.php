<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View         $this
 * @var backend\models\Posts $model
 * @var ActiveForm           $form
 */
?>
<div class="posts-contacts">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->label('Название статьи'); ?>
    <?=
    $form->field($model, 'content')->textarea()->widget(
        CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]
    )->label('Контент')?>
    <div class="form-group">
        <?= Html::submitButton('Добавить материал', ['class' => 'btn-group btn-group-midle']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
