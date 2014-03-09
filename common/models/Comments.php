<?php

namespace common\models;

/**
 * This is the model class for table "comments".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $posts_id
 * @property string $title
 * @property string $comment
 *
 * @property User $user
 * @property Posts $posts
 */
class Comments extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'comments';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'posts_id', 'title', 'comment'], 'required'],
			[['user_id', 'posts_id'], 'integer'],
			[['comment'], 'string'],
			[['title'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'Код комментария',
			'user_id' => 'Пользователь',
			'posts_id' => 'Номер поста',
			'title' => 'Заголовок',
			'comment' => 'Комментарий',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosts()
	{
		return $this->hasOne(Posts::className(), ['id' => 'posts_id']);
	}
}
