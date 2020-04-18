<?php

namespace ElfsightInstagramFeedApi\Core;

class Cache {
    private $Helper;

    private $pluginFile;
    private $cacheTime;

    private $tableName;

    public function __construct($Helper, $config) {
        $this->Helper = $Helper;

        $this->pluginFile = $config['plugin_file'];
        $this->cacheTime = !empty($config['cache_time']) ? $config['cache_time'] : 43200;

        $this->tableName = $this->Helper->getTableName('cache');

        if (!$this->Helper->tableExist($this->tableName)) {
            $this->Helper->tableCreate($this->tableName, array('key' => 'varchar(255)', 'data' => 'longtext'));
        }

        register_deactivation_hook($this->pluginFile, array($this, 'dropTable'));
    }

    public function keyFromQuery($query, $excluded_params = array('access_token')) {
        $key = $query;

        foreach ($excluded_params as $param) {
            $key = $this->Helper->removeQueryParam($key, $param);
        }

        return preg_replace('#\?$#', '', $key);
    }

    public function get($key, $check_expire = true) {
        $cache = $this->Helper->tableRowGet($this->tableName, array('key' => $key));

        if (!$cache || ($check_expire && time() > $cache['updated_at'] + $this->cacheTime)) {
            return null;
        }

        return $cache['data'];
    }

    public function expired($key) {
        $cache = $this->Helper->tableRowGet($this->tableName, array('key' => $key));

        return !$cache || $cache && time() > $cache['updated_at'] + $this->cacheTime;
    }

    public function set($key, $data, $merge = false) {
        if (empty($data)) {
            return false;
        }

        $data = $merge ? $this->merge($data, $this->get($key, false)) : $data;
        $data = is_array($data) ? json_encode($data) : $data;

        return !!$this->Helper->tableRowUpdate(
            $this->tableName,
            array(
                'key' => $key,
                'data' => $data
            ),
            array('key' => $key)
        );
    }

    private function merge($data, $cache_data_json){
        if (empty($cache_data_json) || empty($data)) {
            return $data;
        } else {
            $cache_data = json_decode($cache_data_json, true);
            $unique_data = $this->Helper->uniqueSort(array_merge_recursive($data, $cache_data), 'created_time');

            return $unique_data; // @TODO slice by limit
        }
    }

    public function dropTable() {
        global $wpdb;

        return $wpdb->query("DROP TABLE IF EXISTS $this->tableName");
    }
}
