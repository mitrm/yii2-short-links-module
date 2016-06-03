<?php

use yii\db\Migration;

class m160603_060158_create_short_links_modules extends Migration
{
    public function up()
    {
        $this->createTable('short_links', [
            'id' => $this->primaryKey(),
            'link' => $this->text(),
            'token' => $this->string(50),
            'count_click' => $this->integer()->defaultValue(0),
            'table' => $this->string(250),
            'field_id' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('field_id', 'short_links', 'field_id');
        $this->createIndex('user_id', 'short_links', 'user_id');
        $this->createIndex('table', 'short_links', 'table');
        $this->createIndex('table_field_id', 'short_links', ['table', 'field_id']);

        $this->createTable('short_links_click', [
            'id' => $this->primaryKey(),
            'short_links_id' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

        $this->createIndex('short_links_id', 'short_links_click', 'short_links_id');
        $this->createIndex('created_at', 'short_links_click', 'created_at');
        $this->addForeignKey('FK_shoer_links_click', 'short_links_click', 'short_links_id', 'short_links', 'id');

    }

    public function down()
    {
        $this->dropTable('short_links_click');
        $this->dropTable('short_links');
    }
}
