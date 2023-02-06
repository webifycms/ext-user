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

namespace OneCMS\User\Application\Account\Action;

use OneCMS\Base\Domain\Exception\TranslatableRuntimeException;
use OneCMS\User\Application\Account\Request\ActivateAccountRequest;
use OneCMS\User\Domain\Model\Account\AccountRepositoryInterface;
use OneCMS\User\Domain\Model\Account\PendingAccount;

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
