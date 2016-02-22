<?php
	namespace Home\Controller;
	use Think\Controller;
	class ChangepwdController extends Controller {
	/**
	* 修改密码
	*/
	public function index() {
		$this->display();
	}
	public function changepwd() {
		if (IS_POST) {
			$old_pwd = trim($_POST['password0']);
			$new_pwd = trim($_POST['password']);
			$re_pwd  = trim($_POST['password2']);
			if($new_pwd != $re_pwd) {
				$this->error('两次密码不一样！', U('changepwd/index'),3);
			}

			$userid = $_SESSION['userid'];
			$user = D("User")->where('userid='.$userid)->find();
			if(sha1($old_pwd) != $user['password']) {
        	$this->error('原始密码错误！',U('changepwd/index'),3);
      		}
      		//\Think\Log::record('2222uuuuuuuuuuuuuu'. $user['password'],'ALERT');//调试
			if (D("User")->where(array('userid' => $userid))->save(array('password' => sha1($new_pwd))) !== false) {
				$this->success('密码修改成功！',U('/'),2);
			} else {
				$this->error('密码修改失败！',U('changepwd/index'),3);
			}
			} else {
				$this->display("index");
			}
	}
}