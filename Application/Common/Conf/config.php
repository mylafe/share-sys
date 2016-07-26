<?php
return array(

	// 加载扩展配置文件
	'LOAD_EXT_CONFIG' => 'database',
	'LANG_SWITCH_ON' => true,   // 开启语言包功能

// 数据库配置
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  'qdm106205302.my3w.com', // 服务器地址
	'DB_NAME'               =>  'qdm106205302_db',          // 数据库名
	'DB_USER'               =>  'qdm106205302',      // 用户名
	'DB_PWD'                =>  'lt085121428',          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'think_',    // 数据库表前缀
	//'SHOW_PAGE_TRACE'=>true ,   //显示页面Trace信息
 	'LOG_RECORD' => true, // 开启日志记录
 	//'URL_ROUTER_ON'   => true, //开启路由
	'LOG_LEVEL' =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误


	'URL_ROUTER_ON' => true,// 开启路由
	'URL_ROUTE_RULES'=>array(
	'news/:year/:month/:day' => array('News/archive', 'status=1'),
	'news/:id' => 'News/read',
	'news/read/:id' => '/news/:1',
	),

	'SESSION_OPTIONS'         =>  array(
    'name'                =>  'shareSESSION',	               //设置session名
    'expire'              =>  24*3600*30,                      //SESSION保存30天
    'use_trans_sid'       =>  1,                               //跨页传递
    'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    ),
    'QQ_AUTH'                 => array(
	'APP_ID'         => '101332935', //你的QQ互联APPID
	'APP_KEY'   => 'a5d98009bacbf58f1da88655634572db',
	'SCOPE'          => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',
	'CALLBACK'       => 'http://litao0501.com/qqlogin.php',
	),
);