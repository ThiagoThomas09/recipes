<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%login}}`.
 */
class m250602_231243_create_login_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%login}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'login_time' => $this->datetime()->notNull(),
        ]);

        $this->createIndex(
            'idx-login-user_id',
            '{{%login}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk-login-user',
            '{{%login}}', 'user_id',
            '{{%user}}',  'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-login-user', '{{%login}}');
        $this->dropTable('{{%login}}');
    }
}
