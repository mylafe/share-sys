<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model {
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('userid', 'require', '用户名不能为空！'), //默认情况下用正则进行验证
        //array('userid', '', '该账户已被注册！', 0, 'unique', 1), // 在新增的时候验证userid字段是否唯一
        array('username', '', '该用户名已被注册！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('password', '/^([a-zA-Z0-9@*#]{3,22})$/', '密码格式不正确,请重新输入！', 0),
        array('password2', 'password', '两次密码不一致', 0, 'confirm'), // 验证确认密码是否和密码一致
    );

    /**
     * 自动完成
     */
    protected $_auto = array (
        array('password', 'sha1', 3, 'function') , // 对password字段在新增和编辑的时候使sha1函数处理
        array('lasttime', 'time', 1, 'function'), // 对lasttime字段在新增的时候写入当前时间戳
    );
}