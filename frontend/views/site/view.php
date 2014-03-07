<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\BaseHtmlPurifier as clear;
$clr = function($data){
	return clear::process($data,[
		'Attr.EnableID' => true,
		'HTML.AllowedElements' => array
		(
			'strong'    => TRUE,
			'em'        => TRUE,
			'ul'        => TRUE,
			'ol'        => TRUE,
			'li'        => TRUE,
			'img'       => TRUE,
			'a'         => TRUE,
			'p'         => TRUE,
			'span'  	=> TRUE,
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
<?PHP foreach ($posts as $post): ?>
	<?PHP $this->title = clear::process($post['title']) ?>
	<?PHP $this->registerMetaTag(['description' => clear::process($post['descriptions'])]); ?>
	<?PHP $this->registerMetaTag(['keywords' => clear::process($post['keywords'])]); ?>
	<div class="row">
		<div class="body-content">

			<div class="row">
				<div class="entry">
					<h3 class="header">
						<div class="jumbotron">
							<h1><?PHP ECHO clear::process($post['title']); ?></h1>
						</div>
						<span class="content"> <?PHP ECHO nl2br($clr($post['content'])); ?></span><br/>
						<span class="author"><kbd><?PHP ECHO clear::process($post['c_date']); ?></kbd></span>
						<span class="date"><kbd><?PHP ECHO clear::process($post['m_date']); ?></kbd></span>
						<span class="date"><kbd><?PHP ECHO clear::process($post['user']['username']); ?></kbd></span>
				</div>
				<br/>
			</div>
		</div>
	</div>
<?PHP endforeach ?>
