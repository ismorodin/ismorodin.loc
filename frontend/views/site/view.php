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
    h3 {
        margin-top: 20px;
    }

    .entry {
        margin-top: 10px;
        word-wrap: break-word;
    }

    .header {
        padding-left: 15px;
        text-decoration: underline;
    }

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
        <div class="row">
            <div class="panel panel-default">
                <span class="author"><kbd><?PHP ECHO clear::process($post['c_date']); ?></kbd></span>
                <span class="date"><kbd><?PHP ECHO clear::process($post['m_date']); ?></kbd></span>
                <span class="date"><kbd><?PHP ECHO clear::process($post['user']['username']); ?></kbd></span>

                <div class="jumbotron">
                    <h1><?PHP ECHO clear::process($post['title']); ?></h1>
                </div>
                <div class="panel-body">
                    <span class="content"> <?PHP ECHO nl2br($clr($post['content'])); ?></span><br/>

                </div>
            </div>


            <hr>
            <?PHP
            ECHO \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
                'activePageCssClass' => 'active',
                'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right">',
                'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left">'
            ]);
            ?>
            <div class="form-group">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal', 'style' => 'width:400px;',],
                        ])
                ?>
    <?= $form->field($model, 'title')->label('Заголовок'); ?>
    <?= $form->field($model, 'comment')->textarea()->label('Комментарий'); ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                <?= \yii\helpers\Html::submitButton('Добавить комментарий', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
    <?PHP ActiveForm::end() ?>
            </div>
            <br/>
            <h2>Комментарии:</h2><br/>
    <? foreach ($comments as $comment): ?>
                <div class="comments">

					<span class="comments_author"><kbd><?= $comment['title']; ?></kbd></span>
					<span class="comments_author"><kbd><?= $comment['id']; ?></kbd></span>
                    <span class="comments_author"><kbd><?= $comment['user']['username']; ?></kbd></span>
                    <br>
                    <blockquote class="blockquote"><?= $comment['comment']; ?></blockquote>
                </div>
    <? endforeach ?>
        </div>
        <br/>
    </div>

<?PHP endforeach ?>


