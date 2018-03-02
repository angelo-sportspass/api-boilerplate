<?php
namespace app\models;

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => t('Role ID'),
            'name' => t('Role Name'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }

    /**
     * Get All Users to Specific Roles
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
}