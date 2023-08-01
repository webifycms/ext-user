<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account}}`.
 */
class m211220_032013_create_account_table extends Migration
{
	public function safeUp(): void
	{
		$this->createTable('{{%account}}', [
			'id'                   => $this->primaryKey(),
			'person_id'            => $this->integer()->unique()->notNull(),
			'email'                => $this->string()->unique()->notNull(),
			'username'             => $this->string()->unique()->notNull(),
			'password_hash'        => $this->string()->unique()->notNull(),
			'password_reset_token' => $this->string(),
			'validation_token'     => $this->string()->unique()->notNull(),
			'registered_ip'        => $this->string()->notNull(),
			'activated_at'         => $this->dateTime(),
			'activation_token'     => $this->string()->unique(),
		]);
		$this->addForeignKey('pk-person-id', '{{%account}}', 'person_id', '{{%person}}', 'id', 'CASCADE');
	}

	public function safeDown(): void
	{
		$this->dropForeignKey('pk-person-id', '{{%account}}');
		$this->dropTable('{{%account}}');
	}
}
