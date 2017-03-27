<?php
namespace App\Www\Controllers;

use Illuminate\Fundation\Controller;

class IndexController extends Controller
{
   public function indexAction()
   {
       
       $str  = <<<str
            <div>
                <ul>
                    <li>
                        <a>aaaaaaaaaaaaaa</a>
                        <ul>
                            <li>bbbbbbbbbb</li>
                            <li>bbbbbbbbbb</li>
                            <li>bbbbbbbbbb</li>
                        </ul>
                    </li>
                </ul>
            </div>
str;
   		
        $content  = '<div >';
            $content .= '<ul data-template="nav" data-tag="start" >';
            $content .= '<li >aaaaaaaaaaaaaa</li>';
            $content .= '<li data->bbbbbbbbbbbbbb</li>';
            $content .= '</ul>';
        $content .= '</div>';
        
        preg_match_all('/(data-template\=\"([a-zA-Z_]+)\")+/', $content,$match);
   		
        
        
        
        var_dump($match);
        exit;
        $this->assign('a', 123);
   }
   public function addAction()
   {
    	
   }
}