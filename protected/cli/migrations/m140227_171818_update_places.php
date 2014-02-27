<?php
/**
 * Миграция m140227_171818_update_places
 *
 * @property string $prefix
 */
 
class m140227_171818_update_places extends CDbMigration
{
    public function up() {
        $this->addColumn('{{places}}','sort',"integer COMMENT 'Вес для сортировки'");
    }

    public function down() {
        $this->dropColumn('{{places}}','sort');
    }
}