<?php
/**
 * 用户与角色关联模型
 */
namespace Admin\Model;
use Think\Model;
Class UserRelationModel extends Model{

    //定义主表名称
    Protected $tableName = 'user';

    //定义关联关系
    Protected $_link = array(
        'role'=>array(
            'mapping_type'=>MANY_TO_MANY,//多对多关系
            'foreign_key'=>'userid',//主表在中间表中的字段
            'relation_key'=>'role_id',//副表在中间表中的字段
            'relation_table'=>'think_role_user',//中间表名称
            'mapping_fields'=>'id,name,remark'
            )
        );
}