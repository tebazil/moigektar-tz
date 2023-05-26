<?php

use yii\db\Migration;

/**
 * Class m230523_162302_create_cadnumber
 */
class m230523_162302_create_cadastre extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cadastre',  [
            'id' => 'pk',
            'number' => 'string',
            'address' => 'text',
            'price' => 'decimal(10,2)',
            'area' => 'integer',
            'links_json' => 'text',

            'last_api_updated_at' => 'datetime',
            'last_api_response_json' => 'text',

            'last_api_check_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230523_162302_create_cadnumber cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230523_162302_create_cadnumber cannot be reverted.\n";

        return false;
    }
    */
}
