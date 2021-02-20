<?php

namespace app\models\dataModels;

use Yii;

/**
 * This is the model class for table "otv".
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_outlet_id
 * @property int|null $status
 * @property int|null $created_at
 *
 * @property User $user
 * @property ProjectOutlet $projectOutlet
 * @property OtvDetail[] $otvDetails
 */
class Otv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'project_outlet_id'], 'required'],
            [['user_id', 'project_outlet_id', 'status', 'created_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['project_outlet_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectOutlet::className(), 'targetAttribute' => ['project_outlet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'project_outlet_id' => 'Project Outlet ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ProjectOutlet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectOutlet()
    {
        return $this->hasOne(ProjectOutlet::className(), ['id' => 'project_outlet_id']);
    }

    /**
     * Gets query for [[OtvDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtvDetails()
    {
        return $this->hasMany(OtvDetail::className(), ['otv_id' => 'id']);
    }
}
