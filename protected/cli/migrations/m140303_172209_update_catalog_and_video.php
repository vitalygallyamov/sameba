<?php
/**
 * Миграция m140303_172209_update_catalog_and_video
 *
 * @property string $prefix
 */
 
class m140303_172209_update_catalog_and_video extends CDbMigration
{
    public function up() {
        $this->addColumn('{{catalog}}','on_main',"tinyint COMMENT 'Показывать на главной'");
        $this->addColumn('{{video}}','on_main',"tinyint COMMENT 'Показывать на главной'");
    }

    public function down() {
        $this->dropColumn('{{catalog}}','on_main');
        $this->dropColumn('{{video}}','on_main');
    }

}