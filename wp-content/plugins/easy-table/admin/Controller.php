<?php
namespace EasyTable;

class Controller 
{
    private $layout, $view, $request, $request_path, $layout_path, $view_path;
    
    public function __construct($request = null, $layout = null, $view = null)
    {
        $this->request_path = dirname(__FILE__) . "/request";
        $this->layout_path = dirname(__FILE__) . "/layout";
        $this->view_path = dirname(__FILE__) . "/view";
        
        $this->setRequest($request);
        $this->setLayout($layout);
        $this->setView($view);
    }
    
    public function setRequest($request)
    {
        if (!$request)
        {
            $this->request = null;
            return;
        }
        
        $this->request = str_replace(array(".php", ".PHP"), "", $request);
    }
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function getRequestFile()
    {
        if ( !$this->request)
        {
            return null;
        }
        
        return $this->request_path . "/" . $this->request . ".php";
    }
    
    public function setLayout($layout)
    {
        if ( !$layout)
        {
            $this->layout = null;
            return;
        }
        
        $this->layout = str_replace(array(".php", ".PHP"), "", $layout);
    }
    
    public function getLayout()
    {
        return $this->layout;
    }
    
    public function getLayoutFile()
    {
        if ( !$this->layout)
        {
            return null;
        }
        
        return $this->layout_path . "/" . $this->layout . ".php";
    }
    
    public function setView($view)
    {
        if ( !$view)
        {
            $this->view = null;
            return;
        }
        
        $this->view = str_replace(array(".php", ".PHP"), "", $view);
    }
    
    public function getView()
    {
        return $this->view;
    }
    
    public function getViewFile()
    {
        if ( !$this->view)
        {
            return null;
        }
        
        return $this->view_path . "/" . $this->view . ".php";
    }
    
    public function run()
    {
        $public_url = \EasyTable\Config::BASE_URL;
        
        $js_url = \EasyTable\Config::JS_URL;
        
        $css_url = \EasyTable\Config::JS_URL;
        
        $request = $this->getRequestFile();
        
        $Form = new \EasyTable\Form;
        
        if ($request)
        {
            require_once $this->getRequestFile();   
        }
        
        $view = $this->getViewFile();
        
        $layout = $this->getLayoutFile();
        
        if ($layout)
        {
            require_once $this->getLayoutFile();
        }
        else
        {
            require_once $view;
        }
        
    }
}
