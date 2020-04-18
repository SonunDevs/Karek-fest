<?php

namespace ElfsightInstagramFeedApi\Core;

class Throttle {
    private $Helper;

    private $pluginFile;

    private $tableName;

    private $calls;
    private $time;

    public function __construct($Helper, $config) {
        $this->Helper = $Helper;

        $this->pluginFile = $config['plugin_file'];

        $this->calls = $config['throttle']['calls'];
        $this->time = $config['throttle']['time'];

        $this->tableName = $this->Helper->getTableName('throttle');

        if (!$this->Helper->tableExist($this->tableName)) {
            $this->Helper->tableCreate($this->tableName, array('calls' => 'int(2)'));
        }

        register_deactivation_hook($this->pluginFile, array($this, 'dropTable'));
    }

    public function isLimited() {
        $usage = $this->Helper->tableRowGet($this->tableName, array('id' => 1));

        if ($usage && $usage['calls'] > $this->calls) {
            if (time() < $usage['updated_at'] + $this->time) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function increment() {
        $usage = $this->Helper->tableRowGet($this->tableName, array('id' => 1));

        $calls_cnt = $usage && $usage['calls'] ? $usage['calls'] + 1 : 1;

        if ($usage && $usage['calls'] > $this->calls && time() > $usage['updated_at'] + $this->time) {
            $calls_cnt = 0;
        }

        return !!$this->Helper->tableRowUpdate(
            $this->tableName,
            array('calls' => $calls_cnt),
            array('id' => 1)
        );
    }

    public function dropTable() {
        global $wpdb;

        return $wpdb->query("DROP TABLE IF EXISTS $this->tableName");
    }
}
