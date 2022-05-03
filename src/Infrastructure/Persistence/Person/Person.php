<?php
declare(strict_types=1);

namespace OneCMS\User\Infrastructure\Persistence\Person;

use DateTimeInterface;
use Yii;
use yii\db\ActiveQuery;
use OneCMS\Base\Infrastructure\Persistence\ActiveRecordModel;
use OneCMS\User\Infrastructure\Persistance\Account\Account;
use OneCMS\User\Domain\Model\Person\Person as PersonEntity;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property int $id
 * @property string $uuid
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $trashed_at
 *
 * @property Account $account
 */
final class Person extends ActiveRecordModel
{
    /**
     * @var PersonEntity|null
     */
    private ?PersonEntity $entity = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'first_name', 'last_name', 'created_at'], 'required'],
            [['created_at', 'updated_at', 'trashed_at'], 'safe'],
            [['uuid', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['uuid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'uuid' => Yii::t('user', 'Uuid'),
            'first_name' => Yii::t('user', 'First Name'),
            'last_name' => Yii::t('user', 'Last Name'),
            'created_at' => Yii::t('user', 'Created At'),
            'updated_at' => Yii::t('user', 'Updated At'),
            'trashed_at' => Yii::t('user', 'Trashed At'),
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

    /**
     * Sets the entity.
     *
     * @param PersonEntity $entity
     */
    public function setEntity($entity): void
    {
        $this->entity = $entity;
    }

    /**
     * Handles before save to database.
     *
     * @param bool $insert
     */
    public function beforeSave($insert): bool
    {
        if (!$insert) {
            $this->id = $this->entity->getPersonId();
        }

        $this->uuid = $this->entity->getUuid();
        $this->first_name = $this->entity->getFirstName();
        $this->last_name = $this->entity->getLastName();
        $this->created_at = $this->entity->getTimestamp()->getCreatedAt()->format(self::DEFAULT_DATETIME_FORMAT);
        $this->updated_at = $this->entity->getTimestamp()->getUpdatedAt()->format(self::DEFAULT_DATETIME_FORMAT);

        if ($this->entity->getTrashedAt() instanceof DateTimeInterface) {
            $this->trashed_at = $this->entity->getTrashedAt()->format(self::DEFAULT_DATETIME_FORMAT);
        }

        return parent::beforeSave($insert);
    }
}
