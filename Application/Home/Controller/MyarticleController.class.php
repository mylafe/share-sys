<?php
namespace Home\Controller;
use Think\Controller;
class MyarticleController extends CommonController {
    public function index(){
    	// 获取当前用户的用户信息
        $userid=$_SESSION['userid'];
        // 我的文章
        $arr=M('works')->where(array('userid' => $userid))->order('time DESC')->select();
        $this->assign('typeArr',$arr);// 模板变量赋值
        $this->display();
    }

}