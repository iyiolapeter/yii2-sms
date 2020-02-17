<?php

namespace pso\yii2\sms\models;

use Yii;

/**
 * This is the model class for table "{{%sms_notification}}".
 *
 * @property int $id
 * @property int $provider_id
 * @property string $reference
 * @property string $tag
 * @property string $phone_number
 * @property string $text
 * @property string $message_reference
 * @property string $raw
 * @property int $sms_count
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SmsProvider $provider
 */
class SmsNotification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sms_notification}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_id', 'sms_count'], 'integer'],
            [['reference', 'phone_number', 'text'], 'required'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['reference', 'tag', 'text', 'message_reference', 'raw'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 13],
            [['reference'], 'unique'],
            [['message_reference'], 'unique'],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => SmsProvider::className(), 'targetAttribute' => ['provider_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_id' => 'Provider ID',
            'reference' => 'Reference',
            'tag' => 'Tag',
            'phone_number' => 'Phone Number',
            'text' => 'Text',
            'message_reference' => 'Message Reference',
            'raw' => 'Raw',
            'sms_count' => 'Sms Count',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(SmsProvider::className(), ['id' => 'provider_id']);
    }

    /**
     * {@inheritdoc}
     * @return \pso\yii2\sms\models\queries\SmsNotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \pso\yii2\sms\models\queries\SmsNotificationQuery(get_called_class());
    }
}
