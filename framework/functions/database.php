<?php

    /***
    * 获取数据库实例
    * @param string $dbName 数据库名称
    *
    * @return Common
    */
    function DB()
    {
         static $obj;
         global $_G;

        if (!$obj) {
            /**
             * 加载数据库配置文件
             */

            $obj = new \Medoo\Medoo($_G['database']);
            /**
             * 是否开启调试模式
             */
            if(DEBUG){
                $obj->debug();
            }


        }

        return $obj;

    }

    /** 表名加前缀
     * @param $table
     */
    function table_prefix($tablename){
        if(\Framework\library\conf::G('database')['prefix']){
            $tablename=\Framework\library\conf::G('database')['prefix'].$tablename;
        }
        return $tablename;
    }

    /**
     * 添加纪录
     * @param string $table 数据表名
     * @param array $data 插入数据
     * @return mixed
     */

    function db_insert($tablename, $data = [])
    {
        return DB()->insert($tablename, $data);
    }

    /**
     * 删除记录
     * @param string $table 数据表名
     * @param array $params 参数列表
     * @return mixed
     */
    function db_delete($tablename, $where = [])
    {
        return DB()->delete($tablename, $where);
    }

    /**
     * 更新记录
     * @param string $tablename 数据表名
     * @param array $data 更新记录
     * @param array $params 更新条件
     * @return mixed
     */
    function db_update($tablename,  $data = [],$where = [])
    {
        return DB()->update($tablename,$data,$where);
    }

    /**
     * 只能查询单条记录
     *
     * @param string $tablename
     * @param array $condition 查询条件
     * @param array $fields
     * @return string|Ambigous <mixed, boolean>
     */
    function db_find($tablename, $fields = "*",$where = [])
    {

        return DB()->find($tablename,$fields,$where );
    }

    //limit数组    pageindex//当前第几页   pagesize 每页显示多少条
    /** 查询多条记录
     * @param $tablename
     * @param string $fields
     * @param array $where
     * @param array $limit
     * @param string $orderby
     * @return mixed
     */
    function db_select($tablename, $fields = "*",$where = [],$page=1,$pagesize=10,$orderby=[],$join=[])
    {
            return DB()->select($tablename, $fields,$where,$page,$pagesize,$orderby,$join);
    }

    /**
     * @param $tablename
     * @param string $where
     * @return bool
     */
    function db_has($tablename, $where = [])
    {

        return DB()->has($tablename, $where);
    }

    function db_count($tablename, $where = [])
    {
        return DB()->count($tablename, $where);
    }

    function db_max($tablename,$fields, $where = [])
    {
        return DB()->max($tablename,$fields, $where);
    }

    function db_min($tablename, $fields,$where = [])
    {
        return DB()->min($tablename, $fields,$where);
    }



    function db_avg($tablename,$fields, $where = [])
    {
        return DB()->avg($tablename, $fields,$where);
    }

    function db_sum($tablename, $fields,$where = [])
    {
        return DB()->sum($tablename,$fields, $where);
    }

    /** 执行sql原生语句
     * @param       $sql
     * @param array $where
     *
     * @return mixed
     */
    function db_query($sql, $where = [])
    {

        return DB()->query($sql, $where);
    }

    /** 单条查询
     * @param       $sql
     * @param array $params
     *
     * @return mixed
     */
    function db_fetch($sql, $params = []){
        return DB()->fetch($sql, $params);
    }

    /** 批量查询
     * @param       $sql
     * @param array $params
     *
     * @return mixed
     */
    function db_fetchall($sql, $params = []){
        return DB()->fetchall($sql, $params);
    }

    /** 返回最后一条受影响的id
     * @return mixed
     */
    function db_id(){
        return DB()->id();
    }


    /** 返回执行的sql
     * @param bool $all 返回所有执行的sql 默认只返回最后一条
     *
     * @return mixed
     */
    function db_sql($all=false){
        if($all==true){
            return DB()->log();
        }
        return DB()->last();
    }



