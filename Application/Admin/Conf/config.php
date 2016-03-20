<?php
return array(
	//'配置项'=>'配置值'
	
	'RBAC_SUPERADMIN' =>'admin',//超级管理员
	'ADMIN_AUTH_KEY' =>'superadmin',//超级管理员识别
	'USER_AUTH_ON' => true,//是否开启验证
	'USER_AUTH_TYPE' =>1,//验证类型（1：登录验证，2：时时验证）
	'USER_AUTH_KEY' =>'uuid',//用户认证识别号
	'NOT_AUTH_MODULE' =>'Index',//无需验证的控制器
	'NOT_AUTH_ACTION' =>'addRoleHandle,addNodeHandle,setAccess',//无需认证的方法
	'RBAC_ROLE_TABLE' =>'think_role',//角色表名称
	'RBAC_USER_TABLE' =>'think_role_user',//角色与用户的中间表名称
	'RBAC_ACCESS_TABLE' =>'think_access',//权限表名称
	'RBAC_NODE_TABLE' =>'think_node',//节点表名称



	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'index', // 默认操作名称
);