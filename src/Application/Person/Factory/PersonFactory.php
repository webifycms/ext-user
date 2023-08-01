<?php

declare(strict_types=1);

namespace Webify\User\Application\Person\Factory;

use Webify\Base\Domain\Service\Uuid\UuidServiceInterface;
use Webify\Base\Domain\ValueObject\DateTimeValueObject;
use Webify\Base\Domain\ValueObject\RecycleValueObject;
use Webify\Base\Domain\ValueObject\TimestampValueObject;
use Webify\User\Domain\Model\Person\Person;
use Webify\User\Domain\Model\Person\PersonId;

/**
 * PersonFactory to build Person entity.
 */
final class PersonFactory
{
	public function __construct(
		private readonly UuidServiceInterface $uuidService
	) {
		// code...
	}

	/**
	 * Build Person entity.
	 */
	public function build(array $data): Person
	{
		if (isset($data['personId'])) {
			$this->uuidService->generateFromString($data['personId']);
		}

		$timestamp = isset($data['createdAt']) && isset($data['updatedAt']) ?
			$this->mapTimestamp($data['createdAt'], $data['updatedAt']) : new TimestampValueObject();
		$recycle = isset($data['trashedAt']) ? $this->mapRecycle($data['trashedAt']) : new RecycleValueObject();

		return new Person(
			new PersonId($this->uuidService),
			$data['firstName'],
			$data['lastName'],
			$timestamp,
			$recycle
		);
	}

	/**
	 * Returns mapTimestamp value object that created from given value.
	 */
	private function mapTimestamp(string $createdAt, string $updatedAt): TimestampValueObject
	{
		$createdAt = new DateTimeValueObject($createdAt);
		$updatedAt = new DateTimeValueObject($updatedAt);

		return new TimestampValueObject($createdAt->getDateTime(), $updatedAt->getDateTime());
	}

	/**
	 * Returns mapRecycle value object that created from given value.
	 */
	private function mapRecycle(string $trashedAt): RecycleValueObject
	{
		$trashedAt = new DateTimeValueObject($trashedAt);

		return new RecycleValueObject($trashedAt->getDateTime());
	}
}
