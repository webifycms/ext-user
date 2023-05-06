<?php
/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Application\Account\Action;

use Webify\Base\Domain\Exception\TranslatableRuntimeException;
use Webify\User\Application\Account\Request\ActivateAccountRequest;
use Webify\User\Domain\Model\Account\AccountRepositoryInterface;
use Webify\User\Domain\Model\Account\PendingAccount;

/**
 * This is an action to handle activation of an account use case.
 */
final class ActivateAccountAction
{
	public function __construct(public readonly AccountRepositoryInterface $repository)
	{
	}

	public function execute(ActivateAccountRequest $request): void
	{
		$pendingAccount = $this->repository->getPendingAccountById($request->getAccountId());

		if ($pendingAccount instanceof PendingAccount) {
			$pendingAccount->activate();
			$this->repository->persist($pendingAccount);
		}

		throw new TranslatableRuntimeException('unable_to_activate', ['status' => $pendingAccount->getStatus()]);
	}
}
