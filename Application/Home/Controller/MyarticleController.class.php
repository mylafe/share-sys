<?php
namespace Home\Controller;
use Think\Controller;
class MyarticleController extends CommonController {
    public function index(){
    	// 获取当前用户的用户信息
        $userid=$_SESSION['userid'];
        // 我的文章
        //$arr=M('works')->where(array('userid' => $userid))->order('time DESC')->select();
        

        /*
         *获取文章总数
         */
        $count=M('works')->where(array('userid' => $userid))->count();//一个发表文章

        $where->userid= $userid;
        $where->ispass= 1;
        $count1=M('works')->where($where)->count();//审核通过

        $where->userid= $userid;
        $where->ispass= 0;
        $count0=M('works')->where($where)->count();//审核中

        $where->userid= $userid;
        $where->ispass= 2;
        $count2=M('works')->where($where)->count();//审核未通过

        $page = new \Think\Page($count,12);//实例化分页类 传入总记录数和每页显示的记录数
        $limit = $page->firstRow . ',' . $page->listRows;
        //$show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //var_dump($limit);
        $where->userid= $userid;
        $where->ispass= 1;
        $arr=M('works')->where($where)->order('time DESC')->limit($limit)->select();
        //0审核中，1审核通过, 2未通过,-1删除
        //var_dump($arr);
        $this->page = $page->show();//分页显示输出

        $this->assign('count',$count);//赋值
        $this->assign('count0',$count0);//赋值
        $this->assign('count1',$count1);//赋值
        $this->assign('count2',$count2);//赋值

        $this->assign('typeArr',$arr);// 模板变量赋值
        
        $this->display();
    }

}