<?php
namespace EasyTable;

class Form
{
    public function input($field, $attrs)
    {
        $attr_list = array();
        
        if ($field)
        {
            $field_arr = explode($field, ".");

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
                $attr_k = $attr_v;
                $attr_v = true;
            }
            
            $attr_list[] = $attr_k . '="' . $attr_v . '"';
        }
        
        echo '<input ' . implode(" ", $attr_list) .  '/>';
    }
    
    public function label($label, $attrs)
    {
        echo '<label>';
        echo $label;
        
        if (isset($attrs['required']) && $attrs['required'])
        {
            echo '<span class="description">(required)</span>';
        }
        
        echo '</label>';
    }
}

