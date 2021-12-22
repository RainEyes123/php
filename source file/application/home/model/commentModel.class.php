<?php
/**
 * comment 表的操作类，继承基础模型类
 */
class commentModel extends model {
    /**
    *添加留言
    */
    public function insert() {
        //输入过滤
        $this->filter(array('poster','mail','comment'),'htmlspecialchars');
        $this->filter(array("comment"),'nl2br');
        //接收数据，保存至data
        $data['poster'] = $_POST['poster'];
        $data['mail'] = $_POST['mail'];
        $data['comment'] = $_POST['comment'];
        //为其他字段赋值
        $data['reply'] = '';
        $data['date'] = date('Y-m-d H:i:s');
        // tp3.2中 get_client_ip(),tp5中request()->ip,laravel中$request->getClientIp();等但这里的用REMOTE_ADDR
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        //拼接sql语句
        $sql = "insert into comment set ";
        foreach($data as $k => $v) {
            $sql.="$k=:$k,";
            }
            $sql = rtrim($sql,',');//删除最右边的逗号
            //通过预处理执行SQL
            $this->db->execute($sql,$data,$flag);
            //执行sql并返回
            return $flag;
    }

    /**
    *留言列表
    */
    public function getAll($limit) {//添加留言限制
        //获取排序参数降序，升序
        $order='';
        if(isset($_GET['sort']) && $_GET['sort']== 'desc') {
            $order = 'order by id desc';
        }
        //拼接SQL
        $sql="select poster,comment,date,reply from comment $order limit $limit";
        //查询结果
        $data=$this->db->fetchAll($sql);
        return $data;
    }

    /**
    *留言总数
    */
    public function getNumber() {
        $data = $this->db->fetchRow("select count(*) from comment");//返回留言总数
        return $data['count(*)'];
    }
}