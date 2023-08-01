<?php

declare(strict_types=1);

namespace Webify\User\Application\Person\Request;

use Webify\Base\Domain\ValueObject\TimestampValueObject;
use Webify\User\Domain\Model\Person\PersonId;

/**
 * UpdatePersonRequest class is a simple data transfer object.
 */
class UpdatePersonRequest
{
	public function __construct(
		private readonly PersonId $personId,
		private readonly string $firstName,
		private readonly string $lastName,
		private readonly TimestampValueObject $timestamp,
	) {
		// code...
	}

	public function getPersonId(): PersonId
	{
		return $this->personId;
	}

	public function getFirstName(): string
	{
		return $this->firstName;
	}

	public function getLastName(): string
	{
		return $this->lastName;
	}

	public function getTimestamp(): TimestampValueObject
	{
		return $this->timestamp;
	}
}
