<?php

use yii\db\Migration;

/**
 * Class m181212_152939_type
 */
class m181212_152939_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('good', [
            'id' => 'pk',
            'message' => 'text DEFAULT NULL',
            'type' => 'varchar(100) DEFAULT NULL',
            'original_message' => 'text DEFAULT NULL',
            'url' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
        ], '');
        $this->createTable('need', [
            'id' => 'pk',
            'message' => 'text DEFAULT NULL',
            'type' => 'varchar(100) DEFAULT NULL',
            'original_message' => 'text DEFAULT NULL',
            'url' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
        ], '');
        $this->createTable('service', [
            'id' => 'pk',
            'message' => 'text DEFAULT NULL',
            'type' => 'varchar(100) DEFAULT NULL',
            'original_message' => 'text DEFAULT NULL',
            'url' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
        ], '');
        $this->addColumn('post', 'type', 'varchar(100) DEFAULT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m181212_152939_type cannot be reverted.\n";
        $this->delete('good');
        $this->delete('need');
        $this->delete('service');
        $this->dropColumn('post', 'type');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181212_152939_type cannot be reverted.\n";

        return false;
    }
    */
}
