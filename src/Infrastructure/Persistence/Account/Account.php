<?php

declare(strict_types=1);

namespace Webify\User\Infrastructure\Persistence\Account;

use Webify\User\Infrastructure\Persistence\Person\Person;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%account}}".
 *
 * @property int         $id
 * @property int         $person_id
 * @property string      $email
 * @property string      $username
 * @property string      $password_hash
 * @property null|string $password_reset_token
 * @property string      $validation_token
 * @property string      $registered_ip
 * @property null|string $activated_at
 * @property null|string $activation_token
 * @property Person      $person
 */
class Account extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%account}}';
	}

	public function rules(): array
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

	public function attributeLabels(): array
	{
		return [
			'id'                   => \Yii::t('app', 'ID'),
			'person_id'            => \Yii::t('app', 'Person ID'),
			'email'                => \Yii::t('app', 'Email'),
			'username'             => \Yii::t('app', 'Username'),
			'password_hash'        => \Yii::t('app', 'Password Hash'),
			'password_reset_token' => \Yii::t('app', 'Password Reset Token'),
			'validation_token'     => \Yii::t('app', 'Validation Token'),
			'registered_ip'        => \Yii::t('app', 'Registered Ip'),
			'activated_at'         => \Yii::t('app', 'Activated At'),
			'activation_token'     => \Yii::t('app', 'Activation Token'),
		];
	}

	/**
	 * Gets query for [[Person]].
	 */
	public function getPerson(): ActiveQuery
	{
		return $this->hasOne(Person::class, ['id' => 'person_id']);
	}
}
