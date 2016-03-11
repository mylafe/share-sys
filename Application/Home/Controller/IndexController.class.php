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
         *获取文章总数
         */
        $count=M('works')->where('ispass=1')->count();
        $this->assign('count',$count);//赋值

        /*
         *获取文章信息
         */
        //import('Think.Think.Page');//引入第三方类库（分页方法）
        
        $page = new \Think\Page($count,12);//实例化分页类 传入总记录数和每页显示的记录数
        $limit = $page->firstRow . ',' . $page->listRows;
        //$show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //var_dump($limit);
        $arr=M('works')->where('ispass=1')->order('time DESC')->limit($limit)->select();
        //0审核中，1审核通过, 2未通过，-1删除
        //var_dump($arr);
        $this->page = $page->show();//分页显示输出

        $this->assign('typeArr',$arr);// 模板变量赋值.赋值数据集
        
        $this->display();
    }

}