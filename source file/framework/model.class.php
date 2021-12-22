<!-- 从这开始模型类 -->

<?php
// 基础模型类

class model{
    protected static$db;//保存数据库对象
    public function __construct(){
        $this->initDB();//初始化数据库
    }
    private function initDB(){//初始化数据库函数
        //配置数据库连接信息
        $dbConfig=array('user'=>'root','pass'=>'root','dbname'=>'hcit_msg');
        //实例化数据库操作类
        $this->db=MySQLPDO::getInstance($GLOBALS['config']['db']);//参数为全局的$GLOBALS['config']
    }

    /**
     * 输入过滤
     * @param $arr 需要处理的字段
     * @param $func 用于处理的函数
     */

    protected function filter($arr,$func) {
        foreach ($arr as $v) {
            //指定默认值
            if(!isset($_POST[$v])) {
                $_POST[$v] = '';
            }
            //调用处理函数
            $_POST[$v] = $func($_POST[$v]);
        }
    }
}