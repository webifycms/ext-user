<?php
/**
 * The file is part of the "getonecms/ext-user", OneCMS extension package.
 *
 * @see https://getonecms.com/extension/user
 *
 * @license Copyright (c) 2022 OneCMS
 * @license https://getonecms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person\ValueObject;

use OneCMS\Base\Domain\ValueObject\EmailValueObject;

/**
 * This class represents a person's email address.
 */
final class PersonEmail extends EmailValueObject
{
}
