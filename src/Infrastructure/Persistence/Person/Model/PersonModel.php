<?php

declare(strict_types=1);

namespace Webify\User\Infrastructure\Persistence\Person\Model;

use Webify\Base\Infrastructure\Persistence\DatabaseModel;
use Webify\User\Infrastructure\Persistance\Account\Account;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property int         $id
 * @property string      $uuid
 * @property string      $first_name
 * @property string      $last_name
 * @property string      $created_at
 * @property null|string $updated_at
 * @property null|string $trashed_at
 * @property Account     $account
 */
final class PersonModel extends DatabaseModel
{
	public static function tableName()
	{
		return '{{%person}}';
	}

	public function rules()
	{
		return [
			[['uuid', 'first_name', 'last_name', 'created_at'], 'required'],
			[['uuid', 'first_name', 'last_name'], 'string', 'max' => 255],
			[['uuid'], 'unique'],
			[['created_at', 'updated_at'], 'datetime', 'format' => self::DEFAULT_DATETIME_FORMAT],
			[['trashed_at'], 'datetime', 'default' => null, 'format' => self::DEFAULT_DATETIME_FORMAT],
		];
	}

	public function attributeLabels()
	{
		return [
			'id'         => \Yii::t('user', 'ID'),
			'uuid'       => \Yii::t('user', 'Uuid'),
			'first_name' => \Yii::t('user', 'First Name'),
			'last_name'  => \Yii::t('user', 'Last Name'),
			'created_at' => \Yii::t('user', 'Created At'),
			'updated_at' => \Yii::t('user', 'Updated At'),
			'trashed_at' => \Yii::t('user', 'Trashed At'),
		];
	}

	/**
	 * Gets query for [[Account]].
	 *
	 * @return ActiveQuery
	 */
	public function getAccount()
	{
		return $this->hasOne(Account::class, ['person_id' => 'id']);
	}
}
