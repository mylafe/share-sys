<?php
	namespace Home\Controller;
	use Think\Controller;
	class DetailsController extends Controller {
	/**
	* 读取文章详细信息
	*/
	public function index() {
        // 获取文章详细信息
        $uuid=$_GET['uuid'];
        $info=M('works')->where(array('uuid' => $uuid))->find();
        $this->assign('works',$info);
        //var_dump($uuid);
        //var_dump($info);
        $this->display();
	}
}