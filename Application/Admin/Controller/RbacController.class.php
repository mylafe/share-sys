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
        $field = array('id', 'name', 'title', 'pid');
        $node = M('node')->field($field)->order('sort')->select();
        $node = node_merge($node);

        $this->assign('node',$node);
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
        $this->pid = I('pid', 0, 'intval'); //isset($_GET['pid']) ? $_GET['pid'] : 0;
        $this->level = I('level', 1, 'intval');

        switch ($this->level){
            case 1:
                $this->type = '应用';
                break;
            
            case 2:
                $this->type = '控制器';
                break;

            case 3:
                $this->type = '动作方法';
                break;
        }
        //$this->assign('type',$this);// 模板变量赋值
        //var_dump($type);
        $this->display();
    }
    //添加节点表达处理
    Public function addNodeHandle(){
         if (M('node')->add($_POST)) {
            $this->success('添加成功',U('Admin/Rbac/node'));
        }else{
            $this->error('添加失败');
        }
    }
    //配置权限
    Public function access(){
        $rid = I ('rid',0,'intval');

        $field = array('id','name','title','pid');
        $node = M('node')->order('sort')->field($field)->select();
        
        //原有权限
        $access = M('access')->where(array('role_id'=>$rid))->getField('node_id',ture);//读取一个字段

        //var_dump($node);
        var_dump($access);
        
        $this->node = node_merge($node, $access);

        //var_dump($node);

        $this->rid = $rid;
        $this->display();
    }
    //修改权限
    Public function setAccess(){
        $rid = I('rid', 0,'intval');
        $db = M('access');
        $db->where(array('role_id'=>$rid))->delete();//清空原权限

        //组合新权限
        $data = array();
        foreach ($_POST['access'] as $v) {
            $tmp = explode('_', $v);//把字符串$v以_分割为数组
            //var_dump($v);
            $data[] = array(
                'role_id' => $rid,
                'node_id' => $tmp[0],
                'level' => $tmp[1]
                );
            //var_dump(json_encode($tmp[0]));
        }

        //插入新权限
        if ($db->addAll($data)){
            $this->success('修改成功',U('Admin/Rbac/role'));
        }else{
            $this->error('修改失败');
        }
    }

}