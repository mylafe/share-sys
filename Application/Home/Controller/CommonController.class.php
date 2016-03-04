<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 通用控制器
 * 主要用于验证是否登陆 以及 用户权限
 */
class CommonController extends Controller {
    /* 定义用户id */
    public static $userid = '';
    /**
     * 自动执行
     */
    public function _initialize()
    {
        // 判断用户是否登录
        if (session('userid')) {
            $this->userid = session('userid');
        } else {
            //$this->error('<h1 style="text-align:center; font-size: 50px; font-weight: normal;">-_-!</h1><br>对不起,您还没有登录,正跳转至登录面', U('login/index'));
            redirect(U('login/index'), 3, '<h1 style="text-align:center; font-size: 50px; font-weight: normal; margin-top: 120px;">-_-!<br>对不起,您还没有登录,正跳转至登录面...</h1>');
        }
    }
    //图片上传
    // public function uploadimg(){
    //     import('ORG.Net.UploadFile');
    //     $upload = new UploadFile();// 实例化上传类
    //     $upload->allowExts  = array('jpg','gif','png','jpeg','bmp');// 设置附件上传类型
    //     $upload->savePath =  './Public/Uploads/Works/';// 设置附件上传目录
        
    //     if(!$upload->upload()) {
    //         $this->error($upload->getErrorMsg());
    //     }else{
    //         $info =  $upload->getUploadFileInfo();
    //         return $info;
    //     }
    // }

} 