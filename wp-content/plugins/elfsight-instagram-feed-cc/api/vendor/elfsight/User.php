<?php

namespace ElfsightInstagramFeedApi\Core;

class User {
    private $Helper;

    private $pluginFile;

    private $tableName;

    public function __construct($Helper, $config) {
        $this->Helper = $Helper;

        $this->pluginFile = $config['plugin_file'];

        $this->tableName = $this->Helper->getTableName('user');

        if (!$this->Helper->tableExist($this->tableName)) {
            $this->Helper->tableCreate($this->tableName, array('public_id' => 'varchar(255)', 'data' => 'text'));
        }
    }

    public function get($public_id) {
        return $this->Helper->tableRowGet($this->tableName, array('public_id' => $public_id));
    }

    public function set($public_id, $data) {
        return !!$this->Helper->tableRowUpdate(
            $this->tableName,
            array(
                'public_id' => $public_id,
                'data' => $data
            ),
            array('public_id' => $public_id)
        );
    }
}
