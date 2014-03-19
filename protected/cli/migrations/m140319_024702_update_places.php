<?php
/**
 * Миграция m140319_024702_update_places
 *
 * @property string $prefix
 */
 
class m140319_024702_update_places extends CDbMigration
{
     public function up(){
        $this->addColumn('{{places}}', 'on_main', 'tinyint COMMENT "На главной"');
    }

    public function down(){
        $this->dropColumn('{{places}}', 'on_main');
    }
}