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

namespace Webify\User\Infrastructure\Presentation\Web\Admin\Controller;

use Webify\User\Application\Account\Action\ActivateAccountAction;
use Webify\User\Application\Account\Request\ActivateAccountRequest;
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
