<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\BaseHtmlPurifier as clear;
use yii\helpers\BaseHtml as BH;
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
		font-size: 25pt;
        padding-left: 15px;
        text-decoration: underline;
    }
	.header a {
		color:black;
	}

    .content {
        padding: 5px 0 0 25px;
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

<div class="row">

    <div class="jumbotron">
        <h1>Блог</h1>
    </div>

    <div class="body-content">

        <div class="row">
                <? foreach ($posts as $post): ?>
                <div class="entry">
                    <h3 class="header">
						<?PHP ECHO BH::a($post['title'],"site/view/{$post['id']}",['title' => 'Подробнее']);?><br/>
					</h3>

                    <div class="content"> <?PHP ECHO  substr($post['content'],0,300).' ...';?></div><br/>
                    <span class="author"><kbd><?PHP ECHO $post['c_date']; ?></kbd></span>
                    <span class="date"><kbd><?PHP ECHO $post['m_date']; ?></kbd></span>
                    <span class="date"><kbd>Автор: <?PHP ECHO $post['user']['username']; ?></kbd></span>
                </div>
                <br/>
            <? endforeach ?>
            </div>
    </div>
	<?PHP ECHO \yii\widgets\LinkPager::widget([
		'pagination' => $pages,
		'activePageCssClass' => 'active',
		'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right">',
		'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left">'
	]);
	?>
</div>