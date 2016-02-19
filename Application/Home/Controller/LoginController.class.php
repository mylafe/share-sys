<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }
    /**
     * 用户登录
     */
    public function login()
    {
        // 判断提交方式
        if (IS_POST) {
            // 实例化Login对象
            $login = M('user');

            // 自动验证 创建数据集
            $data['userid']= $_POST['userid'];
            $data['password']= $_POST['password'];
            $data['lasttime']= time();

            if (!$data = $login->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($login->getError());
            }

            // 组合查询条件
            $where = array();
            $where['userid'] = $data['userid'];
            $res = $login->where($where)->field('userid,username,password')->find();

            // 验证用户名 对比 密码
           if ($res && $res['password'] == $data['password']) {
           //if ($res && $res['password'] == $res['password']) {
             // 存储session
                //\Think\Log::record('uuuuuuuuuuuuuu'.$res['userid']."dddddddn".$res['username'],'ALERT');//调试
                session('userid', $res['userid']);          // 当前用户id
                session('username', $res['username']);   // 当前用户名

                $this->success('登录成功,正跳转至系统首页...', U('/'));
            } else {
                $this->error('登录失败,用户名或密码不正确!');
            }
        } else {
            $this->display();
        }
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