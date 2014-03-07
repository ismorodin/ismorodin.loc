<?php

namespace backend\models;

/**
 * This is the model class for table "posts".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $c_date
 * @property string $m_date
 * @property integer $user_id
 *
 * @property User $user
 */
class Posts extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'posts';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'content', 'user_id'], 'required'],
			[['content'], 'string'],
			[['user_id'], 'integer'],
			[['title'], 'string', 'max' => 255],
			[['c_date', 'm_date'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'c_date' => 'C Date',
			'm_date' => 'M Date',
			'user_id' => 'User ID',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
