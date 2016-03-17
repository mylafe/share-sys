<?php
/**
 * 用户与角色关联模型
 */
namespace Admin\Model;
use Think\Model;
Class UserRelationModel extends RelationModel{

    //定义主表名称
    Protected $tableName = 'user';

    //定义关联关系
    Protected $_link = array(
        'role'=>array(
            'mapping_type'=>MANY_TO_MANY,
            'foreign_key'=>'userid',
            'relation_key'=>'role_id',
            'relation_table'=>'hd_role_user'
            )
        );
}