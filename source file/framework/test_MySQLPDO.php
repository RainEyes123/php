<!-- 实例化并调用函数 -->

<?php
header('Content-Type:text/html;charset=utf8');//声明编码

require './MYSQLPDO.class.php';//载入要测试的文件

$dbConfig=array('user'=>'root','pass'=>'root','dbname'=>'hcit_msg');//配置数据库连接信息

$db=MySQLPDO::getInstance($dbConfig);//实例化数据库操作类

// $sql="select * from comment";
// $row=$obj_MySQLPDO->fetchAll($sql);
// echo "<pre>";
// print_r($row);
// echo "</pre>";
// echo "<hr>";
$data=$db->fetchAll('select * from comment');//取全部结果,也可以输出一行
// $row=$obj_MySQLPDO->fetchAll($sql)
echo '<pre>';

print_r($data);

echo "</pre>";