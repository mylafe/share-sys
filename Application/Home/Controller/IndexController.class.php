<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

    	/*
         *获取当前用户的用户信息
         */
        $userid=$_SESSION['userid'];
        $info=M('userinfo')->where(array('userid' => $userid))->find();
        //var_dump($info);
        $this->assign('userinfo',$info);// 模板变量赋值

        /*
         *获取文章信息
         */
        $arr=M('works')->order('time DESC')->select();
        //var_dump($arr);
        $this->assign('typeArr',$arr);// 模板变量赋值
        //$data['title']= $this->msubstr();//函数赋值
        
        /*
         *获取文章总数
         */
        $count=M('works')->count();
        $this->assign('count',$count);//赋值
        $this->display();
    }

}