<?php

use yii\db\Migration;

class m160614_063554_add_position_to_short_links extends Migration
{
    public function up()
    {
        $this->addColumn('short_links', 'title', $this->string(250));
    }

    public function down()
    {
        $this->dropColumn('short_links', 'title');
    }
}
