<?php

namespace Home\Controller;
use Think\Controller;

/**
 * Class UsersController
 * @package Home\Controller
 */
class UsersController extends Controller {
    /**
     * 获取用户信息
     */
    public function userlist()
    {
        $list = M('user')->where(array('userid' => $this->userid))->find();

        var_dump($list);
    }
}