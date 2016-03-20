<?php
/**
 * 用户与角色关联模型
 */
namespace Admin\Model;
use Think\Model\RelationModel;
Class UserRelationModel extends RelationModel{

    //定义主表名称
    Protected $tableName = 'user';

    //定义关联关系
    //SELECT*FROM think_user u left join think_role_user ru on u.uuid=ru.user_id left join think_role r on ru.role_id=r.id;
    Protected $_link = array(
        //关联表名称
        'role'=>array(
            'mapping_type'=>MANY_TO_MANY,//多对多关系
            'foreign_key'=>'user_id',//主表在中间表中的字段
            'relation_key'=>'role_id',//副表在中间表中的字段
            'relation_table'=>'think_role_user',//中间表名称
            'mapping_fields'=>'id,name,remark'
            )
        );
}