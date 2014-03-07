<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\widgets\ActiveForm as AF;
$form = AF::begin();

?>
<?PHP $this->registerMetaTag(['description' => 'Все новости сайта'], 'meta-description'); ?>


<div class="row">
    <div class="col-lg-2" style="word-wrap: break-word">
        <?php
        echo Nav::widget(
            [
                'items' => [
                    [
                        'label'       => 'Материалы',
                        'url'         => ['posts/index'],
                        'linkOptions' => [
                            'addClass' => 'nav nav-pills nav-stacked'
                        ],
                    ],
                    [
                        'label'       => 'Категории',
                        'url'         => ['posts/category'],
                        'linkOptions' => [
                            'addClass' => 'nav nav-pills nav-stacked'
                        ],
                    ],
                ],
            ]
        );
        ?>
    </div>
    <div class="col-lg-10">
		<?PHP ECHO \yii\widgets\LinkPager::widget([
			'pagination' => $pages,
			'activePageCssClass' => 'active',
			'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right">',
			'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left">'
		]);
		?>
        <table class="table">
            <tbody>
			<tr>
				<th colspan="8">
					<?php
					echo Html::SubmitButton('Удалить', array('class' => 'button','name'=>'delete_selected'));
					?>
		<?PHP echo html::a('Удалить',"posts/index/{$post['id']}",['class'=>'btn btn-default glyphicon glyphicon-remove'])?>
				</th>
			</tr>
            <tr>
                <th><?= html::checkbox('set_all', false) ?></th>
                <th><span class="glyphicon glyphicon-th-large"></span></th>
                <th>Заголовок</th>
                <th>Доступ</th>
                <th>Автор</th>
                <th>Дата создания</th>
                <th>Дата<br>редактирования</th>
                <th>№</th>
            </tr>
			<?PHP
			var_dump($posts);
			?>
            <? foreach ($posts as $post): ?>
                <tr>

                    <td><?= $form->field($post,'id')->checkbox(false,['value'=>$post['id']]); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default"><span
                                    class="glyphicon glyphicon-pushpin"></span></button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <li class="glyphicon glyphicon-cog"></li>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo Html::a(
                                            ' Редактировать', array('posts/update', 'id' => $post['id']),
                                            ['class' => 'glyphicon glyphicon-edit']
                                        ); ?>
                                    </li>
                                    <li>
                                        <?php echo Html::a(
                                            ' Удалить', array('posts/delete', 'id' => $post['id']),
                                            ['class' => 'glyphicon glyphicon-trash']
                                        ); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td><kbd><?PHP ECHO $post['title'] ?></kbd></td>
                    <?PHP if ($post['status'] == 1): ?>
                        <td><span class="glyphicon glyphicon-eye-open"></span></td>
                    <?PHP else: ?>
                        <td><span class="glyphicon glyphicon-eye-close"></span></td>
                    <?PHP endif ?>
                    <td><kbd><?PHP ECHO $post['user']['username'] ?></kbd></td>
                    <td><kbd><?PHP ECHO $post['c_date'] ?></kbd></td>
                    <td><kbd><?PHP ECHO $post['m_date'] ?></kbd></td>
                    <td><kbd><?PHP ECHO $post['id'] ?></kbd></td>
                </tr>
            <? endforeach ?>
            </tbody>

        </table>
    </div>
</div>
<?php $form = AF::end();?>
