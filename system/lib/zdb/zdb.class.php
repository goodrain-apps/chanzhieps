<?php
/**
 * The zdb library of chanzhieps, can be used to bakup and restore a database.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     Zdb
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class zdb
{
    /**
     * dbh 
     * 
     * @var object   
     * @access public
     */
    public $dbh;

    /**
     * Construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        global $dbh;
        $this->dbh = $dbh;
    }

    /**
     * Dump db. 
     * 
     * @param  string $fileName 
     * @param  array  $tables 
     * @access public
     * @return object
     */
    public function dump($fileName, $tables = array(), $fields = array(), $mode = 'data,schema', $condations = array(), $replaces = array())
    {
        /* Init the return. */
        $return = new stdclass();
        $return->result = true;
        $return->error  = '';

        /* Get all tables in database. */
        $allTables = array();
        $stmt      = $this->dbh->query('show tables');
        while($table = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $table = current($table);
            $allTables[$table] = $table;
        }

        /* Dump all tables when tables is empty. */
        if(empty($tables)) $tables = $allTables;

        /* Check file. */
        if(empty($fileName))
        {
            $return->result = false;
            $return->error  = 'Has not file';
            return $return;
        }
        if(!is_writable(dirname($fileName)))
        {
            $return->result = false;
            $return->error  = 'The directory is not writable';
            return $return;
        }

        /* Open this file. */
        $fp = fopen($fileName, 'w');
        fwrite($fp, "SET NAMES utf8;\n");
        foreach($tables as $table)
        {
            /* Check table exists. */
            if(!isset($allTables[$table])) continue;

            /* Create sql code. */
            $backupSql = '';
            if(strpos($mode, 'schema') !== false) $backupSql .= "DROP TABLE IF EXISTS `$table`;\n";
            if(strpos($mode, 'schema') !== false) $backupSql .= $this->getSchemaSQL($table);
            if(strpos($mode, 'data') !== false)   $backupSql .= $this->getDataSQL($table, zget($condations, $table), zget($fields, $table), zget($replaces, $table));

            /* Write sql code. */
            fwrite($fp, $backupSql);
        }
        fclose ($fp);
        return $return;
    }

    /**
     * Import DB 
     * 
     * @access public
     * @return void
     */
    public function import()
    {
    }

    /**
     * Get schema SQL.
     * 
     * @param  string    $table 
     * @access public
     * @return string
     */
    public function getSchemaSQL($table)
    {
        $createSql = $this->dbh->query("show create table `$table`")->fetch(PDO::FETCH_ASSOC);
        return $createSql['Create Table'] . ";\n";
    }

    /**
     * Get data SQL.
     * 
     * @param  string    $table 
     * @access public
     * @return string
     */
    public function getDataSQL($table, $where = '', $fields = '*', $replace = false)
    {
        if(empty($fields)) $fields = '*';
        $rows = $this->dbh->query("select {$fields} from `$table` $where")->fetchAll(PDO::FETCH_ASSOC);
        $sql  = '';
        if(!empty($rows))
        {
            /* Create key sql for insert. */
            $keys = array_keys(current($rows));
            $keys = array_map('addslashes', $keys);
            $keys = join('`,`', $keys);
            $keys = "`" . $keys . "`";

            /* Create all value sql. */
            $values = array();
            foreach($rows as $row)
            {
                $value = array_values($row);
                $value = array_map('addslashes', $value);
                $value = join("','", $value);
                $value = "'" . $value . "'";

                $values[] = "($value)";
            }

            if(!$replace) $sql .= "INSERT INTO `$table`($keys) VALUES" . join(',', $values) . ";\n";
            if($replace)  $sql .= "REPLACE INTO `$table`($keys) VALUES" . join(',', $values) . ";\n";
        }
        return $sql;
    }
}
