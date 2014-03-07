<?php

namespace common\models;

/**
 * This is the model class for table "posts".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $keywords
 * @property string $descriptions
 * @property string $c_date
 * @property string $m_date
 * @property integer $user_id
 * @property integer $status
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
			[['user_id', 'status'], 'integer'],
			[['title', 'keywords', 'descriptions'], 'string', 'max' => 255],
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
			'title' => 'Заголовок',
			'content' => 'Контент',
			'keywords' => 'Ключевые слова',
			'descriptions' => 'Описание',
			'c_date' => 'Дата создания',
			'm_date' => 'Дата модификации',
			'user_id' => 'Автор',
			'status' => 'Статус',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
