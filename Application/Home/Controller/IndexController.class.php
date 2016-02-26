<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	// 获取当前用户的用户信息
        $userid=$_SESSION['userid'];
        $info=M('userinfo')->where(array('userid' => $userid))->find();
        //var_dump($info);
        $this->assign('userinfo',$info);// 模板变量赋值
        $this->display();
    }
}