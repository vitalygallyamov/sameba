<?php
/**
 * Миграция m140223_142139_catalog
 *
 * @property string $prefix
 */
 
class m140223_142139_catalog extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{catalog}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{catalog}}', array(
            'id' => 'pk', // auto increment

            'name' => "string COMMENT 'Название'",
            'alias' => "string COMMENT 'Алиас'",
            'gllr_gallery' => "int COMMENT 'Галерея'",
            'category_id' => "int COMMENT 'Категория'",
            'art_id' => "string COMMENT 'Артикул'",
			'price' => "decimal(10,2) COMMENT 'Цена от'",
            'wswg_desc' => "text COMMENT 'Описание'",
            'seo_id' => "int COMMENT 'SEO'",
            'period' => "int COMMENT 'Срок изготоваления'",
            'materials' => "string COMMENT 'Материалы'",
            'places' => "string COMMENT 'Где купить'",
			
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}