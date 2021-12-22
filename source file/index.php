<?php

// /**
// * 前端控制器
//  */
// header('Content-Type:text/html;charset=utf8');
// //载入数据库操作类
// require './framework/MySQLPDO.class.php';
// //载入模型类
// require './framework/model.class.php';
// require './application/home/model/commentModel.class.php';
// //得到控制器类文名
// $c=isset($_GET['c'])?$_GET['c']:'comment';
// //载入控制器类
// //实例化控制器(可变变量)
// $controller_name=$c.'Controller';
// $controller=new $controller_name();
// $action=isset($_GET['a'])?$_GET['a']:'list';
// //调用方法(可变方法)
// $action_name=$action.'Action';
// $controller->$action_name();

require './framework/framework.class.php';//加载框架基础类
$app=new framework;//实例化框架基础类
$app->runApp();//调用runApp,就可以完成所有功能
?>