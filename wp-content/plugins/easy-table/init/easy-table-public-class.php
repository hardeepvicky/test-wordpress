<?php
class EasyTable
{
    private $qBuilder, $wpExtend;
    private static $instance, $baseTableName = "easy_tables";
    public function __construct()
    {
        $this->wpExtend = new \EasyTable\WPExtend();
    }
    
    /*
     * to make class singleton
     */
    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    /**
     * Sets query builder
     * @param \EasyTable\QueryBuilder $queryBuilder
     * @throws exception
     */
    public function setQueryBuilder(\EasyTable\QueryBuilder $queryBuilder)
    {
        $this->qBuilder = $queryBuilder;
    }
    
    /**
     * return data from database table by executing query builder
     * @return array
     */
    public function getQueryResult()
    {
        if (!$this->qBuilder)
        {
            throw new Exception("Query Builder instance not created. Please create query builder and call function setQueryBuilder()");
        }
        
        $record = $this->wpExtend->DB->get_results($this->qBuilder->get());
        return \EasyTable\Util::objToArray($record);
    }
    
    public function getDBFieldList($table)
    {
        return $this->wpExtend->getFieldList($table);
    }
    /*----------------------------------------------------------------------*/
    /*---------------------- Feature Specfic functions ---------------------*/
    /*----------------------------------------------------------------------*/
    
    /**
     * return setting of table
     * @param string $table
     * @return array
     */
    public function getSetting($table)
    {
        $this->qBuilder = new \EasyTable\QueryBuilder(self::$baseTableName);
        $this->qBuilder->setFields(["general_meta"])
                ->setConditions(["table_name" => $table]);

        $record = $this->getQueryResult();

        if (!$record || !isset($record[0]['general_meta']))
        {
            return array();
        }

        return \EasyTable\Util::objToArray(json_decode($record[0]['general_meta']));
    }
    
    /*------------------ Structure -------------------------*/
    
    /**
     * return label of table
     * @param String $table Table name
     */
    public function getLabel($table)
    {
        $this->qBuilder = new \EasyTable\QueryBuilder(self::$baseTableName);
        $this->qBuilder->setFields(["table_name_display"])
                ->setConditions(["table_name" => $table]);

        $record = $this->getQueryResult();

        if (isset($record[0]['table_name_display']))
        {
            return $record[0]['table_name_display'];
        }
    }
    
    public function getFields($table)
    {
        $this->qBuilder = new \EasyTable\QueryBuilder(self::$baseTableName);
        $this->qBuilder->setFields(["field_meta"])
                ->setConditions(["table_name" => $table]);

        $record = $this->getQueryResult();

        if (!$record || !isset($record[0]['field_meta']))
        {
            return array();
        }

        return \EasyTable\Util::objToArray(json_decode($record[0]['field_meta']));
    }
    
    public function getRelationShip($table)
    {
        $this->qBuilder = new \EasyTable\QueryBuilder(self::$baseTableName);
        $this->qBuilder->setFields(["relation_meta"])
                ->setConditions(["table_name" => $table]);

        $record = $this->getQueryResult();

        if (!$record || !isset($record[0]['relation_meta']))
        {
            return array();
        }

        $records = \EasyTable\Util::objToArray(json_decode($record[0]['relation_meta']));

        $data = array();
        foreach($records as $record)
        {
            if ($field)
            {
                if ($field == $record["field"])
                {
                    $data[$record["type"]][] = $record;
                }
            }
            else
            {
                $data[$record["type"]][$record["field"]][] = $record;
            }
        }

        return $data;
    }
    
    
    /*------------------------ Data -----------------------*/
    
    public function getDataList(\EasyTable\QueryBuilder $queryBuilder)
    {
        $setting = $this->getSetting($queryBuilder->getTable);
    
        if ( !isset($setting['field']['list_key_field']) || !isset($setting['field']['list_value_field']))
        {
            return array();
        }

        return easy_table_get_list(easy_table_get_data($queryBuilder),  $setting['field']['list_key_field'], $setting['field']['list_value_field']);
    }
    
    public function getDataParentList($table)
    {
        $queryBuilder = new \EasyTable\QueryBuilder;
    }
    
    /**------------------- Form ----------------------------*/
    public function getForm()
    {
        
    }
}