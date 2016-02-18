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
            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }
            //\Think\Log::record('11111111111111111'.json_encode($data),'ALERT');//调试

            //插入数据库
            if ($id = $user->add($data)) {
                $this->success('注册成功', U('login/index'), 2);
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->display();
        }
    }

}