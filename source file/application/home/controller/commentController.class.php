<?php
/**
 * 留言模块控制器类
 */
class commentController extends platformController{//留言控制器继承平台控制器
    /**
     * 留言列表
     */
    public function listAction(){
        // 实例化模型comment
        $commentModel=new commentModel();
        //取得留言总数
        $num=$commentModel->getNumber();
        //实例化分页类
        $page=new page($num,$GLOBALS['config'][PLATFORM]['pagesize']);//总的记录数，每页显示的记录数
        // 取出所有留言数据
        $data=$commentModel->getAll($page->getLimit());//添加limit限制
        //取得分页导航链接
        $pageList=$page->getPageList();
        // 载入视图文件
        require './application/home/view/comment_list.html';
    }
    /**
     * 查看指定留言信息
     */
    public function infoAction(){
        //接收请求参数
        $id=$_GET['id'];
        //实例化模型,取出数据
        $commend=new commentModel();
        $data=$commend->getByID($id);
        //载入视图文件
        //require 'comment_info.html';
        require './application/home/view/comment_info.html';
    }
    /**
     * 发表留言
     */
    public function addAction(){
        //判断是否是post提交，如果没有为false
        if(empty($_POST)) {
            return false;
        }
        //实例化comment模型
        $commentModel = new CommentModel();
        //调用inert方法
        $pass = $commentModel->insert();
        //判断是否成功
        if($pass) {
            $this->jump('index.php','发表成功');//调用jump，修改方法
        } else {
            $this->jump('index.php','发表失败');
        }
     }
}