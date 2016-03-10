<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	//获取所有文章
    	$arr=M('works')->order('time DESC')->select();
    	$this->assign('allArr',$arr);//赋值
    	//var_dump($arr);
        $this->display();
    }
}