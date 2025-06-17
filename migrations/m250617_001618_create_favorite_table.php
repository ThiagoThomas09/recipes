<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m250617_001618_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'user_id' => $this->integer()->notNull(),
            'recipe_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
        ]);

        $this->addPrimaryKey(
            'pk-favorite',
            '{{%favorite}}',
            ['user_id', 'recipe_id']
        );

        $this->createIndex('idx-favorite-user',   '{{%favorite}}', 'user_id');
        $this->createIndex('idx-favorite-recipe', '{{%favorite}}', 'recipe_id');

        $this->addForeignKey(
            'fk-favorite-user',
            '{{%favorite}}', 'user_id',
            '{{%user}}',     'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-favorite-recipe',
            '{{%favorite}}', 'recipe_id',
            '{{%recipe}}',   'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favorite}}');
    }
}
