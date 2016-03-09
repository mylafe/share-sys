<?php
	namespace Home\Controller;
	use Think\Controller;
	class PersonController extends Controller {
	/**
	* 读取个人资料
	*/
	public function index() {
        if($_SESSION['userid']==null || $_SESSION['userid']== ''){
            $this->error("非法操作",U('Login/index'));
        }
        // 获取当前用户的用户信息
        $userid=$_SESSION['userid'];
        $info=M('userinfo')->where(array('userid' => $userid))->find();
        //var_dump($info);
        $this->assign('userinfo',$info);// 模板变量赋值
        $this->display();
	}
	/**
	* 修改个人资料
	*/
	public function personedit() {
		if (IS_POST) {
			$username = trim($_POST['username']);
			$userid = $_SESSION['userid'];

			if (D("user")->where(array('userid' => $userid))->save(array('username' => $username)) !== false)
			{
				$this->success('修改成功！',U('/'),2);
				M('userinfo')->where(array('userid' => $userid))->save(array('username' => $username));//用户信息表
			} else {
				$this->error('修改失败！',U('person/index'),3);
			}
			} else {
				$this->display("index");
			}
	}
	/**
	* 上传头像
	*/
	public function doedit(){
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/Uploads/UserPic/'; // 设置附件上传根目录
	    // $upload->savePath  =     ''; // 设置附件上传（子）目录
	    $info   =   $upload->uploadOne($_FILES['photo']);
	    // 上传文件 
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	        $this->success('上传成功！');
	        //$data['logo']=$info['savepath'].$info['savename'];
	    	//1 转换array to json
	    	//$obj=json_encode($info);
	    	$userid = $_SESSION['userid'];
	    	D("userinfo")->where(array('userid' => $userid))->save(array('picture' => $info['savepath'].$info['savename']));
	    	//2 使用json 拼接处 真实的图片上传地址
	    	 //$tempString = $obj->photo->savePath.$obj->photo->savaName;
	    	 //var_dump($tempString);
	    	//3 拿到地址 更新数据库
	    	//$userinfo->where(array('userid' => $userid))->setField('picture',$tempString);
	        //var_dump("123".json_encode($info),'ALERT');
	        //\Think\Log::record('uuuuuuuuuuuuuu'.json_encode($info),'ALERT');//调试
	    }
	}
}