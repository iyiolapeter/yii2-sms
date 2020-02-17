<?php

namespace pso\yii2\sms\migrations;

use yii\db\Migration;

/**
 * Class m191110_105544_init
 */
class m191110_105544_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        if ($this->db->schema->getTableSchema('{{%sms_notification}}', true) === null) {
            $this->createTable('{{%sms_notification}}', [
                'id' => $this->primaryKey(),
                'reference' => $this->string()->notNull()->unique(),
                'phone_number' => $this->string(13)->notNull(),
                'text' => $this->string()->notNull(),
                'message_reference' => $this->string()->null()->unique(),
                'raw' => $this->string()->null(),
                'sms_count' =>$this->integer()->null(),
                'status' => "ENUM('pending', 'processed', 'completed') NOT NULL DEFAULT 'pending'",
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            ], $tableOptions);
         }
         $this->addColumn('{{%sms_notification}}', 'provider_id', $this->integer()->null()->after('id'));
         $this->addColumn('{{%sms_notification}}', 'tag', $this->string()->null()->after('reference'));
         $this->createTable('{{%sms_provider}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'title' => $this->string()->notNull(),
            'class' => $this->string()->notNull(),
            'config' => $this->json()->null(),
            'status' => "ENUM('enabled', 'disabled') NOT NULL DEFAULT 'enabled'",
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->addForeignKey('fk_sms_notification_provider','{{%sms_notification}}', 'provider_id', '{{%sms_provider}}','id','RESTRICT', 'CASCADE');
        $this->createTable('{{%sms_setting}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'title' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191110_105544_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191110_105544_init cannot be reverted.\n";

        return false;
    }
    */
}
