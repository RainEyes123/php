<?php
/**
 * admin模型类
 */
class adminModel extends model{
    /**
     * 验证登录
     */
    public function checkByLogin(){
        //过滤输入数据
        $this->filter(array('username','password'),'trim');
        //接收输入数据
        $username=$_POST['username'];
        $password=$_POST['password'];
        echo "username = $username <br>";
        echo "password = $password <br>";
        //通过用户名查询密码信息
        $sql="select password,salt from admin where username= '$username' ";
        echo "sql = $sql ";
        $data=$this->db->fetchRow($sql,array(':username'=>$username));
        //判断用户名和密码
        if(!$data){
            //用户名不存在
            //echo "user error";
            return false;
        }
        //返回密码比较结果
        $pass = $data['password'];
        $shuru = md5($password.$data['salt']);
        echo "shrur data = $shuru <br>";
        echo "qry data = $pass <br>";
        return md5($password.$data['salt'])==$data['password'];
    }
}
?>