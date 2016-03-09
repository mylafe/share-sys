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
            $data['title']= $_POST['title'];
            $data['contents']= $_POST['contents'];
            $data['userid'] = $_SESSION['userid'];
            $data['time'] = date("Y-m-d H:i:s" ,time());

            // var_dump($data);
            
            /**
             * 上传文章缩略图
             */
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Uploads/Works/'; // 设置附件上传根目录
            $info   =   $upload->uploadOne($_FILES['picture']);
            // 上传文件 
            if(!$info) {
            // 上传错误提示错误信息
                $this->error($upload->getError());
            }else{
            // 上传成功
                $data['picture']=$info['savepath'].$info['savename'];//图片路径
                 }
                //var_dump($info);
                //var_dump($info['savepath'].$info['savename']);

             // 防止输出中文乱码
             header("Content-type: text/html; charset=utf-8");
            
            $data['uuid']= $this->create_guid();//uuid赋值

            //插入数据库
            if ($id = $works->add($data)) {
                //var_dump($data);
                $this->success('发布成功', U('index/index'), 2);
            } else {
                $this->error('发布失败');
            }
        } else {
            $this->display();
        }
    }

    //uuid算法
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