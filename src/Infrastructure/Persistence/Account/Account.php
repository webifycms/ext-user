<?php

namespace OneCMS\User\Infrastructure\Persistance\Account;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use OneCMS\User\Infrastructure\Persistance\Person\Person;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property int $id
 * @property int $person_id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $validation_token
 * @property string $registered_ip
 * @property string|null $activated_at
 * @property string|null $activation_token
 *
 * @property Person $person
 */
class Account extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'email', 'username', 'password_hash', 'validation_token', 'registered_ip'], 'required'],
            [['person_id'], 'integer'],
            [['activated_at'], 'safe'],
            [['email', 'username', 'password_hash', 'password_reset_token', 'validation_token', 'registered_ip', 'activation_token'], 'string', 'max' => 255],
            [['person_id'], 'unique'],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_hash'], 'unique'],
            [['validation_token'], 'unique'],
            [['activation_token'], 'unique'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'validation_token' => Yii::t('app', 'Validation Token'),
            'registered_ip' => Yii::t('app', 'Registered Ip'),
            'activated_at' => Yii::t('app', 'Activated At'),
            'activation_token' => Yii::t('app', 'Activation Token'),
        ];
    }

    /**
     * Gets query for [[Person]].
     *
     * @return ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }
}
