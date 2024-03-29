<?php

declare(strict_types=1);

namespace Webify\User\Infrastructure\Presentation\Admin\Controller;

use Webify\Base\Domain\Service\Uuid\UuidServiceInterface;
use Webify\User\Application\Person\Repository\PersonRepositoryInterface;
use Webify\User\Infrastructure\Presentation\Admin\Form\Person\CreateFormPerson;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class PersonController.
 *
 * @version 0.0.1
 *
 * @since   0.0.1
 *
 * @author  Mohammed Shifreen
 */
final class PersonController extends Controller
{
	public function __construct(
		string $id,
		Module $module,
		private readonly PersonRepositoryInterface $repository,
		private readonly UuidServiceInterface $uuidService,
		array $config = []
	) {
		parent::__construct($id, $module, $config);
	}

	/**
	 * List all the persons.
	 */
	public function actionList(): void
	{
	}

	/**
	 * Displays the person creation form.
	 */
	public function actionCreate(): string
	{
		$form = new CreateFormPerson();

		return $this->render('create', compact('form'));
	}

	/**
	 * Save the data that has been submitted from person creation form.
	 */
	public function actionSave(): Response
	{
		$form = new CreateFormPerson();

		if (!$form->save($this->repository, $this->uuidService)) {
			app()->session->setFlash('fail', translate('user', 'Failed to create Person.'));

			return $this->redirect(['create']);
		}

		app()->session->setFlash('fail', translate('user', 'Failed to create Person.'));

		return $this->redirect(['list']);
	}

	/**
	 * Displays the person edit form.
	 */
	public function actionEdit(): void
	{
		// code...
	}

	/**
	 * Update the data that has been submitted from person edit form.
	 */
	public function actionUpdate(): void
	{
		// code...
	}
}
