<?php
namespace EasyTable;

class QueryBuilder
{
    private $table, $fields, $conditions, $orders, $groups;
    
    public function __construct($table)
    {
        $this->table = $table;
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    public function get()
    {
        $field_str = "*";
        
        if ($this->fields)
        {
            $field_str = self::getFields($this->fields);
        }
        
        $q = "SELECT $field_str FROM " . $this->table;
        
        if ($this->conditions)
        {
            $q .= " WHERE " . self::getWhere($this->conditions);
        }
        
        if ($this->groups)
        {
            $q .= " GROUP BY " . implode(", ", $this->groups);
        }
        
        if ($this->orders)
        {
            $q .= " ORDER " . self::getOrders($this->orders);
        }
        
        return $q;
    }
    
    public function setFields($fields)
    {
        if (!is_array($fields))
        {
            throw new Exception("Expected Array for set fields");
        }
        
        $this->fields = $fields;
        
        return $this;
    }
    
    public function addField($f)
    {
        $this->fields[] = $f;
        
        return $this;
    }
    
    public function setConditions($conditions)
    {
        if (!is_array($conditions))
        {
            throw new Exception("Expected Array for set conditions");
        }
        
        $this->conditions = $conditions;
        
        return $this;
    }
    
    public function addCondition($key, $value)
    {
        $this->conditions[$key] = $value;
        
        return $this;
    }
    
    public function setOrders($orders)
    {
        if (!is_array($orders))
        {
            throw new Exception("Expected Array for set orders");
        }
        
        $this->orders = $orders;
        
        return $this;
    }
    
    public function addOrder($field, $dir)
    {
        $this->orders[$field] = $dir;
        
        return $this;
    }
    
    public function setGroups($groups)
    {
        if (!is_array($groups))
        {
            throw new Exception("Expected Array for set groups");
        }
        
        $this->groups = $groups;
        
        return $this;
    }
    
    public function addGroup($field)
    {
        $this->groups[] = $field;
        
        return $this;
    }
    
    public static function getOrders($orders)
    {
        $list = array();
        foreach($orders as $field => $dir)
        {
            $list[] = $field . " " . $dir;
        }
        
        return implode(", ", $list);
    }
    
    public static function getFields($fields)
    {
        $list = array();
        foreach($fields as $alias => $field)
        {
            if (is_numeric($alias))
            {
                $list[] = $field;
            }
            else
            {
                $list[] = $field . " AS " . $alias;
            }
        }
        
        return implode(", ", $list);
    }
    
    public static function getWhere($conditions, $group_op = "AND")
    {
        $where = array();
        
        foreach($conditions as $k => $v)
        {
            if (is_array($v))
            {
                $temp = strtoupper($k);
                if ($temp == "NOT")
                {
                    $where[] = "NOT " . self::getWhere($v, "AND");
                }
                else if ($temp == "OR")
                {
                    $where[] = self::getWhere($v, "OR");
                }
                else
                {
                    $where[] = self::getWhere($v, "AND");
                }
            }
            else
            {
                $ops = array("=", "LIKE", ">", "<", "!", ">=",  "=<", "&");
                $op_found = false;
                foreach($ops as $op)
                {
                    if (strpos(strtoupper($k), $op) !== false)
                    {
                        $op_found = true;
                    }
                }
                
                if (!$op_found)
                {
                    $k = "`$k` =";
                }
                
                $where[] = $k . " '" . $v . "'";
            }
        }

        return "(" . implode(" $group_op ", $where) . ")";
    }
}
