<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipe_category}}`.
 */
class m250604_013234_create_recipe_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipe_category}}', [
            'recipe_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            'pk-recipe_category',
            '{{%recipe_category}}',
            ['recipe_id','category_id']
        );

        $this->createIndex(
            'idx-rc-recipe_id',
            '{{%recipe_category}}',
            'recipe_id'
        );

        $this->createIndex(
            'idx-rc-category_id',
            '{{%recipe_category}}',
            'category_id'
        );

        $this->addForeignKey(
            'fk-rc-recipe',
            '{{%recipe_category}}',
            'recipe_id',
            '{{%recipe}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-rc-category',
            '{{%recipe_category}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-rc-recipe', '{{%recipe_category}}');
        $this->dropForeignKey('fk-rc-category', '{{%recipe_category}}');

        $this->dropPrimaryKey('pk-recipe_category', '{{%recipe_category}}');
        $this->dropIndex('idx-rc-recipe_id', '{{%recipe_category}}');
        $this->dropIndex('idx-rc-category_id', '{{%recipe_category}}');

        $this->dropTable('{{%recipe_category}}');
    }
}
