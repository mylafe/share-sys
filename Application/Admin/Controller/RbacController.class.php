<?php
namespace Admin\Controller;
use Think\Controller;
class RbacController extends CommonController {
    //uuid
    public function create_guid($namespace = '') {
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = '{' .   
            substr($hash,  0,  8) . 
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12) .
            '}';
    return $guid;
  }

    //用户列表
    Public function index(){
        $this->user = D('UserRelation')->field('password',ture)->relation(true)->select();//查询除去password字段
        //$result = D('UserRelation')->relation(true)->select();
        print_r($this);
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
        $this->role = M('role')->select();
        $this->display();
    }
    //添加用户表单处理
    Public function addUserHandle(){
        //用户信息
        //print_r($_POST);
        
        $data['uuid']= $this->create_guid();//uuid赋值

        $user = array(

            'uuid' =>$data['uuid'],//uuid赋值
            'userid' =>I('username'),
            'username' => I('username'),
            'password' =>I('password','','sha1'),
            'lasttime' =>date("Y-m-d H:i:s" ,time()),
            'loginip' =>get_client_ip()
            );
        //所属角色
        $role = array();
        if ($uid = M('user')->add($user)){
            foreach ($_POST['role_id'] as $v) {
                $role[] = array(
                    'role_id'=>$v,
                    'user_id'=>$data['uuid'],
                    );
            }
            //var_dump($uuid);
            //添加用户角色
            M('role_user')->addAll($role);

            $this->success('添加成功', U('Admin/Rbac/index'));
        }else{
            $this->error('添加失败');
        }
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
        $access = M('access')->where(array('role_id'=>$rid))->getField('node_id', true);//读取一个字段,加true

        //var_dump($node);
        //print_r($access);
        //var_dump($access);

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