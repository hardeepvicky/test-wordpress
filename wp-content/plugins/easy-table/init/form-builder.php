<?php
namespace EasyTable;

class FormFieldBuilder
{
    private $form, $field, $type, $meta;
    public $attr, $dropdownOptions, $dropdownEmptyOption;
    
    public function __construct(\EasyTable\FormBuilder $form, $field)
    {
        $this->form = $form;
        $this->field = $field;
        
        if ( !isset($form->meta[$field]))
        {
            throw new Exception("Invalid Field - " . $field);
        }
        
        if ( !isset($form->meta[$field]['type']))
        {
            throw new Exception("Invalid Field Type of " . $field);
        }
        
        $this->meta = $form->meta[$field];
        $this->type = $this->meta[$field]['type'];
        
        $this->emptyOption = "Please Select";
    }
    
    public function addAttr($key, $value)
    {
        $this->attr[$key] = $value;
    }
    
    public function removeAttr($key)
    {
        unset($this->attr[$key]);
    }
    
    public function clearAttr()
    {
        $this->attr = array();
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getMeta()
    {
        return $this->meta;
    }
    
    public function getFieldName()
    {
        return $this->form->getTable() . "." . $this->field;
    }
    
    public function getLabel()
    {
        return $this->meta[$this->field]["label"];
    }
    
    public function getDropdownOptions()
    {
        if (isset($this->meta["pick_options_from_parent_table"]) && $this->meta["pick_options_from_parent_table"])
        {
            $easy_table = \EasyTable::getInstance();
            $easy_table->
        }
        else if (isset($this->meta['dropdown_options']) && $this->meta['dropdown_options'])
        {
            return easy_table_get_list($this->meta['dropdown_options'], "key", "value");
        }
        
        return false;
    }
    
    public function html()
    {
        $Form = \EasyTable\Form::getInstance();
        
        $attr = $this->attr;
        
        if (isset($this->meta['is_required']) && $this->meta['is_required'])
        {
            $attr['required'] = true;
        }

        if (!isset($this->meta['is_fillable']) || !$this->meta['is_fillable'])
        {
            $attr['readonly'] = true;
            $attr['disabled'] = true;
        }

        if ($this->type == "text")
        {
            echo $Form->input($this->getFieldName(), $attr);
        }
        else if ($this->type == "select")
        {
            echo $Form->select($select_table . "." . $field, $meta["select"]['options'], "Please Select", $attr);
        }
    }
}

class FormBuilder
{
    private $table, $fields, $attr, $meta, $type;
    
    public function __construct($table)
    {
        $this->table = $table;
        
        $easy_table = \EasyTable::getInstance();
        
        $this->meta = $easy_table->getFields($table);
        
        $this->fields = array_keys($this->meta);
        
        $this->emptyOption = "Please Select";
    }
    
    public function Field($field)
    {
        return new FormFieldBuilder($this, $field);
    }
    
    public function addAttr($key, $value)
    {
        $this->attr[$key] = $value;
    }
    
    public function removeAttr($key)
    {
        unset($this->attr[$key]);
    }
    
    public function clearAttr()
    {
        $this->attr = array();
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    public function html()
    {
        $attr_list = array();
        foreach($this->attr as $attr_k => $attr_v)
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
        
        echo "<Form " . implode(" ", $attr_list) .">";
    }
}