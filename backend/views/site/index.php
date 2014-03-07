<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\html as html;
$this->title = 'Система управления сайтом';
?>
<div class="row">

    <div class="jumbotron">
        <h1>Добро пожаловать в панель администрирования!</h1>

        <p class="lead">Здесь вы можите просмотреть полную статистику сайта..</p>

        <p><?PHP echo html::a('Статистика сайта','site/stats',['class'=> "btn btn-default"]);?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h1>Информация о системе</h1>
				<table class="table-condensed">
					<tr>
						<td>Версия PHP</td>
						<td>=></td>
						<td> <?PHP echo phpversion();?></td>
					</tr>
					<tr>
						<td>PHPINFO</td>
						<td>=></td>
						<td> <?PHP echo 'OPEN';?></td>
					</tr>
				</table>
            </div>

        </div>

    </div>
</div>
