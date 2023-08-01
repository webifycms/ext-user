<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m211209_181048_create_person_table extends Migration
{
	public function safeUp(): void
	{
		$this->createTable('{{%person}}', [
			'id'         => $this->primaryKey(),
			'uuid'       => $this->string()->notNull()->unique(),
			'first_name' => $this->string()->notNull(),
			'last_name'  => $this->string()->notNull(),
			'created_at' => $this->dateTime()->notNull(),
			'updated_at' => $this->dateTime(),
			'trashed_at' => $this->dateTime(),
		]);
	}

	public function safeDown(): void
	{
		$this->dropTable('{{%person}}');
	}
}
