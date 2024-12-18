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

namespace Webify\User\Infrastructure\Service\Bootstrap;

use Webify\Base\Domain\Service\Application\ApplicationServiceInterface as DomainApplicationServiceInterface;
use Webify\Base\Domain\Service\Dependency\DependencyServiceInterface;
use Webify\Base\Infrastructure\Service\Application\ApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Application\ConsoleApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseConsoleBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterControllersBootstrapInterface;
use yii\console\controllers\MigrateController;
use function Webify\Base\Infrastructure\set_alias;

/**
 * Handles the console bootstrap functionality for the application.
 * Extends the base functionality provided by BaseConsoleBootstrapService
 * and implements the necessary interface for registering controllers.
 */
final class ConsoleBootstrapService extends BaseConsoleBootstrapService implements RegisterControllersBootstrapInterface
{
    /**
     * The class construct.
     */
    public function __construct(
        DependencyServiceInterface $dependencyService,
        ApplicationServiceInterface|DomainApplicationServiceInterface|ConsoleApplicationServiceInterface $appService
    )
    {
        set_alias('@User', \dirname(__DIR__));
        parent::__construct($dependencyService, $appService);
    }

    /**
     * @inheritDoc
     */
    public function init(): void
	{

	}

    /**
     * @inheritDoc
     */
    public function controllers(): array
    {
        return [
            'migrate-user' => [
                'class'          => MigrateController::class,
                'migrationPath'  => '@User/database/migrations',
            ],
        ];
    }
}
