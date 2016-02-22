<?php
	namespace Home\Controller;
	use Think\Controller;
	class PersonController extends Controller {
	/**
	* 读取个人资料
	*/
	public function index() {
        // 获取当前用户的用户信息
        $userid=$_SESSION['userid'];
        $info=M('user')->where(array('userid' => $userid))->select();
        $this->assign('userinfo',$info);
        $this->display();
	}
	public function upload(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功
        $this->success('上传成功！');
    }
	}
}