<?php
namespace Admin\Controller;
use Think\Controller;
class RbacController extends CommonController {

    //用户列表
    Public function index(){
        $this->display();
    }

    //角色列表
    Public function role(){
        $role = M('role')->select();
        $this->assign('role',$role);
        $this->display();
    }

    //节点列表
    Public function node(){
        $this->display();
    }

    //添加用户
    Public function addUser(){
        $this->display();
    }

    //添加角色
    Public function addRole(){
        $this->display();
    }
    //添加角色处理
    Public function addRoleHandle(){
        if (M('role')->add($_POST)) {
            $this->success('添加成功',U('Admin/Rbac/role'));
        }else{
            $this->error('添加失败');
        }
    }

    //添加节点
    Public function addNode(){
        $this->display();
    }
    

}