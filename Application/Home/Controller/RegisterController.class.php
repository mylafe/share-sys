<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
    public function index(){
        $this->display();
    }
      /**
     * 用户注册
     */
    public function register()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $user = D('user');
            $data['userid']= $_POST['userid'];
            $data['username']= $_POST['username'];
            $data['password']= sha1($_POST['password']);
            $data['userid']= $_POST['userid'];
            // if($_POST['uerid'] == '' || $_POST['username'] == '' || $_POST['password'] == ''|| $_POST['userid'] == ''){
            // $this->error("都填写了吗？仔细检查");
            // }
            

            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }
            //\Think\Log::record('11111111111111111'.json_encode($data),'ALERT');//调试

            $data['uuid']= $this->create_guid();//uuid赋值

            //插入数据库
            if ($id = M('user')->add($data)) {
                $this->success('注册成功', U('login/index'), 2);
                M('userinfo')->add($data);//用户信息表
            } else {
                $this->error('注册失败');
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