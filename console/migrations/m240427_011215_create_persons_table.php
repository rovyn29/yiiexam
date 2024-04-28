<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m240427_011215_create_persons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'birthdate' => $this->string()->notNull(),
            'age' => $this->integer(11)->notNull(),
            'sex' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
            'province' => $this->string()->notNull(),
            'municipality' => $this->string()->notNull(),
            'contact' => $this->integer(11)->notNull(),
            'status' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');
    }
}
