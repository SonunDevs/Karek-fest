<?php

namespace ElfsightInstagramFeedApi\Core;

class Helper {
    public $pluginSlug;

    public function __construct($pluginSlug) {
        $this->pluginSlug = $pluginSlug;
    }

    public function getOptionName($name) {
        return str_replace('-', '_', $this->pluginSlug) . '_' . $name;
    }

    public function getTableName($name) {
        global $wpdb;

        return esc_sql($wpdb->prefix . $this->getOptionName($name));
    }

    public function tableExist($table_name) {
        global $wpdb;

        return !!$wpdb->get_var($wpdb->prepare(
            "SHOW TABLES LIKE %s",
            $table_name
        ));
    }

    public function tableCreate($table_name, $columns) {
        global $wpdb;

        $columns['updated_at'] = 'int(12)';
        $columns_query = '';

        foreach ($columns as $key => $type) {
            $columns_query .= '`' . $key . '` ' . $type . ' NOT NULL,';
        }

        return $wpdb->query(
            "CREATE TABLE $table_name (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, $columns_query PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
        );
    }

    public function tableRowGet($table_name, $where) {
        global $wpdb;

        list ($key, $value) = $this->getKeyValue($where);

        return $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE `$key` = %s",
            esc_sql($value)
        ), ARRAY_A);
    }

    public function tableRowExist($table_name, $where) {
        global $wpdb;

        list ($key, $value) = $this->getKeyValue($where);

        return !!$wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE `$key` = %s",
            esc_sql($value)
        ));
    }

    public function getKeyValue($array) {
        $keys = array_keys($array);
        $values = array_values($array);
        return array($keys[0], $values[0]);
    }

    public function tableRowUpdate($table_name, $data, $where) {
        global $wpdb;

        $data['updated_at'] = time();

        if ($this->tableRowExist($table_name, $where)) {
            $status = $wpdb->update(
                $table_name,
                $data,
                $where
            );
        } else {
            $status = $wpdb->insert(
                $table_name,
                $data
            );
        }

        return !!$status;
    }

    public function addQueryParam($url, $key, $val) {
        return $url . (strpos($url,'?') !== false ? '&' : '?') . $key . '=' . $val;
    }

    public function removeQueryParam($url, $key) {
        $result = $url;
        $url_data = parse_url($url);

        if (!empty($url_data['query'])) {
            parse_str($url_data['query'], $query_params);

            if (!empty($query_params[$key])) {
                unset($query_params[$key]);
            }

            $result = $url_data['path'] . '?' . http_build_query($query_params);
        }

        return $result;
    }

    public function uniqueSort($array, $key) {
        $result = array();

        $array_unique = array();

        $ids = array();
        $timestamps = array();

        foreach ($array as $item) {
            if (!in_array($item['id'], $ids)) {
                $ids_unique[] = $item['id'];
                $array_unique[$item['id']] = $item;
                $timestamps[$item['id']] = $item[$key];
            }
        }

        arsort($timestamps);

        foreach ($timestamps as $id => $node) {
            $result[] = $array_unique[$id];
        }

        return $result;
    }

    public function arrayMergeAssoc() {
        $mixed = null;
        $arrays = func_get_args();

        foreach ($arrays as $k => $arr) {
            if ($k === 0) {
                $mixed = $arr;
                continue;
            }

            $mixed = array_combine(
                array_merge(array_keys($mixed), array_keys($arr)),
                array_merge(array_values($mixed), array_values($arr))
            );
        }

        return $mixed;
    }
}
