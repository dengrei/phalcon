<?php
namespace App\Admin\Controllers;

use App\Admin\Controllers\BaseController;
class IndexController extends BaseController
{
	
   public function indexAction()
   {
       $this->display();
   }
   public function doLoginAction()
   {
    	$user = $this->request->getPost('username');
    	$pwd  = $this->request->getPost('password');
    	
    	$user = \App\Models\AdModel::get_rows();
   }
   public function show404Action()
   {
   		echo 'admin 404';
   }
}