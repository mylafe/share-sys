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
            $works = D('works');
            $data['title']= $_POST['title'];
            $data['contents']= $_POST['contents'];
            

            // 自动验证 创建数据集
            if (!$data = $works->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($works->getError());
            }

            $data['uuid']= $this->create_guid();//uuid赋值

            //插入数据库
            if ($id = $works->add($data)) {
                $this->success('发布成功', U('index/index'), 2);
            } else {
                $this->error('发布失败');
            }
        } else {
            $this->display();
        }
    }
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