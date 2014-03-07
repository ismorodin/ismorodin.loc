<?php

namespace common\models;

/**
 * This is the model class for table "profiles".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $firstName
 * @property string $lastName
 *
 * @property User $user
 */
class Profiles extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'profiles';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id'], 'required'],
			[['user_id'], 'integer'],
			[['firstName', 'lastName'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'firstName' => 'Имя',
			'lastName' => 'Фамилия',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUser()
	{
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
}
