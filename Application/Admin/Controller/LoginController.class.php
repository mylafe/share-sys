<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    /**
     * 用户登录
     */
    public function login()
    {
        // 判断提交方式
        if (IS_POST) {
            // 实例化Login对象
            $login = D('admin');

            // 自动验证 创建数据集
            //$data['admin']= $_POST['admin'];
            
            //防止乱码
            header("Content-type: text/html; charset=utf-8");
            // 组合查询条件
            $where = array();
            $where['admin'] =  $_POST['admin'];
            $res = $login->where($where)->field('admin,password')->find();
            //var_dump($res);

            // 验证用户名 对比 密码
           if ($res && $res['password'] == sha1($_POST['password'])) {
                //\Think\Log::record('uuuuuuuuuuuuuu'.$res['userid']."dddddddn".$res['username'],'ALERT');//调试
                session('admin', $res['admin']);   // 当前用户名

                $this->success('登录成功,正跳转至后台...', U('index/index'));

                 //$login->where("userid = {$res['userid']}")->setField('lasttime',date("Y-m-d H:i:s" ,time()));//更新最后登录时间
            } else {
                 $this->error('登录失败,用户名或密码不正确!');
            }
        } else {
            $this->display();
        }
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
        session(null);
        redirect(U('login/index'), 2, '<h1 style="text-align:center; font-size: 50px; font-weight: normal; margin-top: 120px;">^O^ <br>正在安全退出</h1>');
    }

}