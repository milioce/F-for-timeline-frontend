<?php
namespace Core\Router;
use Core\Application\Application;

class parseUrl
{
    public static function parseURL()
    {
        $request = array();
        $action='';
        $controller='';
        $params=array();
    
        $data = explode('/',$_SERVER['REQUEST_URI']);
        
        if(isset($data[1]))
            $controller = $data[1];
    
        if(isset($data[2]))
            $action = $data[2];
         
    
        if(sizeof($data)>3)
        {
            for($a=3;$a<sizeof($data);$a+=2)
            {
                $params[$data[$a]] = $data[$a+1];
            }
        }
         
        if(sizeof($data)>3 && sizeof($data)%2==0)
        {
            $controller = 'error';
            $action = '403';
        }
        
        if($controller !='')
        {
            if(!is_file($_SERVER['DOCUMENT_ROOT'].'/../modules/Application/src/Application/controllers/'.$controller.'.php'))
            {
                $controller = 'error';
                $action = '404';
            }
        }
        else 
            $controller = Application::getConfig()['default_controller'];
        
        
        
        if($action =='')
            $action = Application::getConfig()['default_action'];
            
        $request = array('controller'=>$controller,
            'action'=>$action,
            'params'=>$params
        );
              
         
        return $request;
    }
    
}













