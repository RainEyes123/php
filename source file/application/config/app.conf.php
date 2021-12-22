<!-- 统一管理可修改的参数，设置，保存在一个大的多维数组中 -->

<?php
return array(
//数据库配置
    'db'=>array(
//数据库环境
        'user'=>'root',
        'pass'=>'root',
        'dbname'=>'hcit_msg',
    ),
//整体信息
    'app'=>array(
        'default_platform'=>'home',//默认平台
    ),
//前台配置
    'home'=>array(
        'default_controller'=>'comment',//默认控制器
        'default_action'=>'list',//默认方法
        'pagesize'=>2,//每页评论数
    ),
//后台配置
    'admin'=>array(
        'default_controller'=>'comment',//默认控制器
        'default_action'=>'list',//默认方法
        'pagesize'=>10,//每页评论数
    ),
);
?>