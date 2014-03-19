<?php
/**
 * Миграция m140313_151143_contacts
 *
 * @property string $prefix
 */
 
class m140313_151143_contacts extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{contacts}}', '{{phones}}', '{{socials}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{contacts}}', array(
            'id' => 'pk', // auto increment

            'title' => "string COMMENT 'Название раздела'",
			'seo_id' => "int COMMENT 'SEO раздел'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{phones}}', array(
            'id' => 'pk', // auto increment

            'phone' => "string NOT NULL COMMENT 'Телефон'",
            'on_main' => "tinyint DEFAULT 0 COMMENT 'На главной'",
            'page' => "int COMMENT 'Страница'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{socials}}', array(
            'id' => 'pk', // auto increment

            'name' => "string COMMENT 'Название'",
            'img_preview' => "string NOT NULL COMMENT 'Изображение'",
            'url' => "string NOT NULL COMMENT 'Ссылка'",
            'page' => "int COMMENT 'Страница'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //insert default data

        $this->insert('{{seo}}',array(
            'meta_title' => "Контакты",
            'meta_keys' => "Контакты",
            'meta_desc' => "Контакты",
            'meta_html' => "Контакты"
        ));

        $this->insert('{{contacts}}', array(
            'title' => 'Контакты',
            'seo_id' => Yii::app()->db->getLastInsertID()
        ));

        $this->insert('{{phones}}', array(
            'phone' => "+7 (3452) 700-899",
            'on_main' => 1,
            'page' => 1,
        ));

        $this->insertMultiple('{{socials}}', array(
            array('name' => 'Facebook', 'img_preview' => 'fb', 'url' => '', 'page' => 1),
            array('name' => 'VK', 'img_preview' => 'vk', 'url' => '', 'page' => 1),
            array('name' => 'Twitter', 'img_preview' => 'tw', 'url' => '', 'page' => 1),
            array('name' => 'Одноклассники', 'img_preview' => 'od', 'url' => '', 'page' => 1),
        ));
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