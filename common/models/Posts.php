<?php

namespace common\models;

/**
 * This is the model class for table "posts".
 *
 * @author Ivan Smorodin <ismorodin@hotmail.com>
 * @property string $id pk news
 * @property string $title - заголовок
 * @property string $content - контент
 * @property string $keywords - ключевые слова
 * @property string $descriptions - описание
 * @property string $c_date - дата создания
 * @property string $m_date - дата модификации
 * @property integer $user_id PK from [[User::className()]]
 * @property integer $status - видимость поста
 * 
 * @property User $user
 */
class Posts extends \yii\db\ActiveRecord {

    /**
     * @return string table name
     */
    public static function tableName() {
        return 'posts';
    }

    /**
     * @return array rulles and validations
     */
    public function rules() {
        return [
            [['title', 'content', 'user_id'], 'required'],
            [['content'], 'string'],
            [['user_id', 'status'], 'integer'],
            [['title', 'keywords', 'descriptions'], 'string', 'max' => 255],
            [['c_date', 'm_date'], 'string', 'max' => 128]
        ];
    }

    /**
     * @return array labels for table Posts
     */
    public function attributeLabels() {
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
     * This is relation with User
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

	public function getComments()
	{
		return $this->hasMany(Comments::className(), ['posts_id' => 'id']);
	}
}
