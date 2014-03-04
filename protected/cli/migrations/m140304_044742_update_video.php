<?php
/**
 * Миграция m140304_044742_update_video
 *
 * @property string $prefix
 */
 
class m140304_044742_update_video extends CDbMigration
{
    public function up() {
        $this->addColumn('{{video}}','img_video',"string COMMENT 'Обложка'");
    }

    public function down() {
        $this->dropColumn('{{video}}','img_video');
    }
}