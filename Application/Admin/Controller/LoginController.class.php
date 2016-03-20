<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    /**
     * 用户登录
     */
    public function login(){
        if(!IS_POST) halt('页面不存在');

        $userid = I('userid');
        $password = I('password','','sha1');

        $user = M('user')->where(array('userid'=>$userid))->find();
        if (!$user||$user['password'] !=$password) {
            $this->error('账号或密码错误');
        }

        // if($user['lock']) $this->error('用户被锁定');
        
        $data = array(
            // 'id' =>
            'lasttime' =>date("Y-m-d H:i:s" ,time()),
            'loginip'=>get_client_ip(),
            );
        
        M('user')->save($data);

        session('userid',$user['userid']);
        session('username',$user['username']);
        session('lasttime',date('Y-m-d H:i:s', $user['lasttime']));
        session('loginip',$user['loginip']);


        //超级管理员识别
        if($user['username']==C('RBAC_SUPERADMIN')){
            session(C('ADMIN_AUTH_KEY'),true);
        }
        //读取用户权限
        //import('Org.Util.Rbac');
        // $Rbac = new \Org\Util\Rbac();
        // $Rbac::saveAccessList();
        //print_r($_SESSION);

        

        $this->redirect('Admin/Index/index');

    }
    /** 
     *  
     * 验证码生成 
     */  
    public function verify_c(){  
        $Verify = new \Think\Verify();  
        $Verify->fontSize = 18;  
        $Verify->length   = 4;  
        $Verify->useNoise = false;  
        $Verify->codeSet = '0123456789';  
        $Verify->imageW = 130;  
        $Verify->imageH = 50;  
        //$Verify->expire = 600;  
        $Verify->entry();  
    }
    
    /**
     * 用户注销
     */
    public function logout()
    {
        // 清除所有session
        // session(null);
        // redirect(U('login/index'), 2, '<h1 style="text-align:center; font-size: 50px; font-weight: normal; margin-top: 120px;">^O^ <br>正在安全退出</h1>');
        
        session_unset();
        session_destroy();
        $this->redirect('Admin/Login/index');
    }

}