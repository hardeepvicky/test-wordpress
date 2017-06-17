<?php
namespace EasyTable;

use EasyTable\Util as Util;
class Form
{
    private $defaultInputAttrs = array(), $defaultLabelAttrs = array();
    private static $instance;
    
    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function setDefaultInputAttr($key , $value)
    {
        $this->defaultInputAttrs[$key] = $value;
    }
    
    public function getDefaultInputAttr($key)
    {
        return isset($this->defaultInputAttrs[$key]) ? $this->defaultInputAttrs[$key] : null;
    }
    
    public function setDefaultLabelAttr($key , $value)
    {
        $this->defaultLabelAttrs[$key] = $value;
    }
    
    public function getDefaultLabelAttr($key)
    {
        return isset($this->defaultLabelAttrs[$key]) ? $this->defaultLabelAttrs[$key] : null;
    }
    
    public function input($field, $attrs = array())
    {
        if (!isset($attrs['type']))
        {
            $attrs['type'] = 'text';
        }
        
        $field_arr = explode(".", $field);
        array_unshift($field_arr, "data");        
        $post_value = $this->_getValueFromPOST($field_arr, $_POST);
        
        if ($post_value)
        {
            if (isset($attrs['type']) && ( 
                    in_array(strtolower($attrs['type']), array("checkbox", "radio"))
            ))
            {
                $attrs["checked"] = true;
            }
            else
            {
                $attrs["value"] = $post_value;
            }
        }
        
        $attr_list = $this->_getAttrList($field, array_merge($this->defaultInputAttrs, $attrs));
        
        echo '<input ' . implode(" ", $attr_list) .  '/>';
    }
    
    public function select($field, $options, $empty = "",  $attrs = array())
    {
        $field_arr = explode(".", $field);
        array_unshift($field_arr, "data");
        $post_value = $this->_getValueFromPOST($field_arr, $_POST);
        
        if ($post_value)
        {
            $attrs["value"] = $post_value;
        }
        
        $attr_list = $this->_getAttrList($field, array_merge($this->defaultInputAttrs, $attrs));
        
        echo '<select ' . implode(" ", $attr_list) .  '>';
        
        if ($empty)
        {
            echo '<option value="">' . $empty . '</option>';
        }
        
        foreach($options as $v => $txt)
        {
            if ($post_value == $v)
            {
                echo '<option selected="selected" value="' . $v . '">' . $txt . '</option>';
            }
            else
            {
                echo '<option value="' . $v . '">' . $txt . '</option>';
            }
        }
        
        echo "</select>";
    }
    
    public function label($label, $attrs = array())
    {
        $attr_list = $this->_getAttrList(null, array_merge($this->defaultLabelAttrs, $attrs));
        
        echo '<label ' . implode(" ", $attr_list) .  '>' . $label;
        
        if (isset($attrs['required']) && $attrs['required'])
        {
            echo '<span class="description">(required)</span>';
        }
        
        echo '</label>';
    }
    
    public function prevPost()
    {
        $data = Util::getFormArrayToCurlArray($_POST);
        if ($data)
        {
            foreach($data as $field => $value)
            {
                echo '<input type="hidden" name="' . $field . '" value="' . $value . '">';
            }
        }
    }
    
    public function _getAttrList($field, $attrs)
    {
        $attr_list = array();
        
        if ($field)
        {
            $field_arr = explode(".", $field);

            $real_field = "data";

            foreach($field_arr as $obj)
            {
                $real_field .= "[$obj]";
            }
            
            $attr_list[] = 'name="' . $real_field . '"';
        }
        
        foreach($attrs as $attr_k => $attr_v)
        {
            if(is_numeric($attr_k))
            {
                if (is_array($attr_v))
                {
                    continue;
                }
                
                $attr_k = $attr_v;
            }
            
            if ( !is_array($attr_v) && !is_object($attr_v))
            {
                $attr_list[] = $attr_k . '="' . $attr_v . '"';
            }
        }
        return $attr_list;
    }
    
    private function _getValueFromPOST($hirerchy, $post, $i = 0)
    {
        if (isset($post[$hirerchy[$i]]))
        {
            if (is_array($post[$hirerchy[$i]]))
            {
                return $this->_getValueFromPOST($hirerchy, $post[$hirerchy[$i]], $i + 1);
            }
            else
            {
                return $post[$hirerchy[$i]];
            }
        }
        else
        {
            return null;
        }
    }
}

