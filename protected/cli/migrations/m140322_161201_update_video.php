<?php
/**
 * Миграция m140322_161201_update_video
 *
 * @property string $prefix
 */
 
class m140322_161201_update_video extends CDbMigration
{
    public function up(){
        $this->addColumn('{{video}}', 'rating', 'int COMMENT "Рейтинг"');
    }

    public function down(){
        $this->dropColumn('{{video}}', 'rating');
    }
}