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
	/**
	 * 发布文章
	 */
	public function doaddarticle(){
		// 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $works = M('works');
            //$data['picture']= $_POST['picture'];
            
            // $info=$this->uploadimg();
            // $data['picture']=$info[0]['savename'];
            $data['title']= $_POST['title'];
            $data['contents']= $_POST['contents'];
            $data['userid'] = $_SESSION['userid'];

            var_dump($data);
            var_dump($_SESSION['userid']);

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Uploads/Works/'; // 设置附件上传根目录
            $info   =   $upload->uploadOne($_FILES['picture']);
            // 上传文件 
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                //$this->success('上传成功！');

                D("works")->save(array('picture' => $info['savepath'].$info['savename']));
            }


            // 自动验证 创建数据集
            if (!$data = $works->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($works->getError());
            }

            $data['uuid']= $this->create_guid();//uuid赋值

            //插入数据库
            if ($id = $works->add($data)) {
                //$this->success('发布成功', U('index/index'), 2);
            } else {
                $this->error('发布失败');
            }
        } else {
            $this->display();
        }
    }

    // /**
    // * 上传文章缩略图
    // */
    // public function doedit(){
    //     $upload = new \Think\Upload();// 实例化上传类
    //     $upload->maxSize   =     3145728 ;// 设置附件上传大小
    //     $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    //     $upload->rootPath  =     './Public/Uploads/UserPic/'; // 设置附件上传根目录
    //     // $upload->savePath  =     ''; // 设置附件上传（子）目录
    //     $info   =   $upload->uploadOne($_FILES['photo']);
    //     // 上传文件 
    //     if(!$info) {// 上传错误提示错误信息
    //         $this->error($upload->getError());
    //     }else{// 上传成功
    //         $this->success('上传成功！');
    //         //$data['logo']=$info['savepath'].$info['savename'];
    //         //1 转换array to json
    //         //$obj=json_encode($info);
    //         $userid = $_SESSION['userid'];
    //         D("userinfo")->where(array('userid' => $userid))->save(array('picture' => $info['savepath'].$info['savename']));
    //     }
    // }

    public function create_guid($namespace = '') {
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = '{' .   
            substr($hash,  0,  8) . 
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12) .
            '}';
    return $guid;
  }

}