<?php
	namespace Home\Controller;
	use Think\Controller;
	class ArticleController extends Controller {
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
	
}