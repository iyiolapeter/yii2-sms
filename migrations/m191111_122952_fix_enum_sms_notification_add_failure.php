<?php

namespace pso\yii2\sms\migrations;

use yii\db\Migration;

/**
 * Class m191111_122952_fix_enum_sms_notification_add_failure
 */
class m191111_122952_fix_enum_sms_notification_add_failure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%sms_notification}}', 'status', "ENUM('pending', 'processed', 'completed', 'failed') NOT NULL DEFAULT 'pending'");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191111_122952_fix_enum_sms_notification_add_failure cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191111_122952_fix_enum_sms_notification_add_failure cannot be reverted.\n";

        return false;
    }
    */
}
