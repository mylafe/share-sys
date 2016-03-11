<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	/*
         *获取文章总数
         */
        $count=M('works')->count();
        $this->assign('count',$count);//赋值

        $count0=M('works')->where('ispass=0')->count();
        $this->assign('count0',$count0);//赋值 未审核的数量

        /*
         *获取文章信息
         */
        //import('Think.Think.Page');//引入第三方类库（分页方法）
        
        $page = new \Think\Page($count,10);//实例化分页类 传入总记录数和每页显示的记录数
        $limit = $page->firstRow . ',' . $page->listRows;
        //$show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //var_dump($limit);
        $arr=M('works')->where('ispass!=-1')->order('time DESC')->limit($limit)->select();//所有文章
        $arr0=M('works')->where('ispass=0')->order('time DESC')->limit($limit)->select();//未审核的文章
        //0审核中，1审核通过, 2未通过
        //var_dump($arr);
        $this->page = $page->show();//分页显示输出

        $this->assign('allArr',$arr);// 模板变量赋值.所有文章
        $this->assign('allArr0',$arr0);// 未审核的文章
        
        $this->display();
    }
    public function pass(){

    	$uuid=$_GET['uuid'];

        $info=M('works')->where(array('uuid' => $uuid))->save(array('ispass' => '1'));

        if ($info) {
                $this->success('修改成功', U('index/index'), 2);
            } else {
                $this->error('修改失败', U('index/index'),3);
            }
    }
    public function delete(){

    	$uuid=$_GET['uuid'];

        $info=M('works')->where(array('uuid' => $uuid))->save(array('ispass' => '-1'));

        if ($info) {
                $this->success('删除成功', U('index/index'), 2);
            } else {
                $this->error('删除失败', U('index/index'),3);
            }

    }

}