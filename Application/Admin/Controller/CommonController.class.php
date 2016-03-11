<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 通用控制器
 * 主要用于验证是否登陆 以及 用户权限
 */
class CommonController extends Controller {
    /* 定义用户id */
    public static $admin = '';
    /**
     * 自动执行
     */
    public function _initialize()
    {
        // 判断用户是否登录
        if (session('admin')) {
            $this->userid = session('admin');
        } else {
            //$this->error('<h1 style="text-align:center; font-size: 50px; font-weight: normal;">-_-!</h1><br>对不起,您还没有登录,正跳转至登录面', U('login/index'));
            redirect(U('login/index'), 3, '<h1 style="text-align:center; font-size: 50px; font-weight: normal; margin-top: 120px;">O(∩_∩)O<br>欢迎回来,管理员,正跳转至登录...</h1>');
        }
    }
    
} 