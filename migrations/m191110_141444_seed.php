<?php

namespace pso\yii2\sms\migrations;

use yii\db\Migration;


/**
 * Class m191110_141444_seed
 */
class m191110_141444_seed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%sms_setting}}', [
            'name' => 'sms_enabled',
            'title' => 'Enable SMS',
            'value' => '1'
        ]);
        $this->insert('{{%sms_setting}}', [
            'name' => 'sms_active_provider',
            'title' => 'SMS Active Provider',
            'value' => 'infobip'
        ]);
        $this->insert('{{%sms_provider}}', [
            'name' => 'infobip',
            'title' => 'Infobip SMS',
            'class' => \pso\yii2\sms\components\providers\Infobip::class
        ]);
        $this->insert('{{%sms_provider}}', [
            'name' => 'bulksmsnigeria',
            'title' => 'BulkSMS Nigeria',
            'class' => \pso\yii2\sms\components\providers\BulkSmsNigeria::class
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191110_141444_seed cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191110_141444_seed cannot be reverted.\n";

        return false;
    }
    */
}
