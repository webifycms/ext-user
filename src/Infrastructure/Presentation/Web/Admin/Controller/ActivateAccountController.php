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

namespace OneCMS\User\Infrastructure\Presentation\Web\Admin\Controller;

use OneCMS\User\Application\Account\Action\ActivateAccountAction;
use OneCMS\User\Application\Account\Request\ActivateAccountRequest;
use yii\base\Module;
use yii\web\Controller;

final class ActivateAccountController extends Controller
{
	/**
	 * The object constructor.
	 *
	 * @param array<mixed> $config
	 */
	public function __construct(
		string $id,
		Module $module,
		private readonly ActivateAccountAction $activateAction,
		array $config = []
	) {
		parent::__construct($id, $module, $config);
	}

	public function actionIndex(int $id): void
	{
		try {
			$request = new ActivateAccountRequest($id);

			$this->activateAction->execute($request);
		} catch (\Throwable $th) {
			throw $th;
		}
	}
}
