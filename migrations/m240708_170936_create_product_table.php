<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240708_170936_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'preco' => $this->decimal(10, 2)->notNull(),
            'client_id' => $this->integer()->notNull(),
            'photo' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Create index for column `client_id`
        $this->createIndex(
            '{{%idx-product-client_id}}',
            '{{%product}}',
            'client_id'
        );

        // Add foreign key for table `{{%client}}`
        $this->addForeignKey(
            '{{%fk-product-client_id}}',
            '{{%product}}',
            'client_id',
            '{{%client}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key for table `{{%client}}`
        $this->dropForeignKey(
            '{{%fk-product-client_id}}',
            '{{%product}}'
        );

        // Drop index for column `client_id`
        $this->dropIndex(
            '{{%idx-product-client_id}}',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}