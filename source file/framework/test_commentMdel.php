<?php
header("Content-Type:text/html;charset=utf8");//载入数据库操作类
require 'MySQLPDO.class.php';
//载入模型类
require 'model.class.php';
//载入留言模型类
// require './application/config/app.conf.php';
require 'commentModel.class.php';
//实例化comment模型
$comment = new CommentModel();
//调用模型中的方法取得结果
echo'<pre>';
print_r($comment->getAll());//调用方法
print_r($comment->getByID(1));
echo'</pre>';
