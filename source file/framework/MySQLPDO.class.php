<!-- 1.连接数据库
2.执行SQL语句
3.处理结果集 
ps：书上的注释挺好的
-->

<?php
header("Content-Type:text/html;charset=utf-8");//申明编码格式
class MySQLPDO {//定义一个类
    private $dbConfig=array(
        'db'=>'mysql',//数据库
        'host'=>'localhost',//服务器
        'prot'=>'3306',//端口
        'pass'=>'',//密码
        'charset'=>'utf8',//字符集
        'dbname'=>'hcit_msg', //默认数据库
    );
    //PDO实例
    private $db;
    private static $instance;    //单例模式，本类对象使用
    //私有构造方法
    private function __construct($params){//构造方法 类实例化时自动调用
        //初始化属性
        $this->dbConfig=array_merge($this->dbConfig,$params);    //初始化一个PDO对象,类的内部进行实例化
        //连接服务器
        $this->connect();
    }
    /**
     * 获得单例对象
     * @param $params array 数据库连接信息
     * @return object 单列对象
     */
    public static function getInstance($params = array()){// 单例对象
        if(!self::$instance instanceof self){               //静态方法，只能类本身访问。
            self::$instance = new self($params);            // 如果$instancenew不是则 self实例一个
        }
        return self::$instance;//返回类的实例对象
    }
    /**
     * 私有克隆
     */
    private function __clone(){
    }

    private function connect(){//连接目标服务器
        try{
            $dsn="{$this->dbConfig['db']}:host={$this->dbConfig['host']};"
            ."port={$this->dbConfig['port']};dbname={$this->dbConfig['dbname']};"
                ."charset={$this->dbConfig['charset']}";
            //实例化PDO
            $this->db = new PDO($dsn,$this->dbConfig['user'],$this->dbConfig['pass']);//第一个参数$dsn，第二user，第三pass
            //设定字符集
            $this->db->query("set names {$this->dbConfig['charset']}");
        }catch(PDOException $e) {
            //错误提示
            die("数据库操作失败: {$e->getMessage()}");//失败并报错，停止
        }
    }
    /**
     * 执行SQL语句
     * @param string $sql SQL语句
     * @return object PDOStatement
     */
    public function query($sql){// 执行SQL函数
        $rst=$this->db->query($sql);//把db->query($sql)看作一个整体,在当前类中防问这个整体,db没被继承，但在当前类中实例化了。
        if($rst === false){
            $error = $this->db->errorInfo();
            //print_r($error);
            die("执行SQL语句失败: ERROR{$error[1]}($error[0];{$error[2]}))");//如果错误给出原因
        }
        return $rst;//返回执行结果
    }
    /**
     * 取得一行记录
     * @param $sql $string 执行SQL语句
     * @return array 关联数组结果
     */
    public function fetchRow($sql,$data=array()){
        return $this->execute($sql,$data)->fetch(PDO::FETCH_ASSOC);//返回关联数组
    }
    /**
     * 取得的所有结果
     * @param string $sql 执行SQL语句
     * @return array 关联数组结果
     */
    public function fetchAll($sql,$data=array()){
        return $this->execute($sql,$data)->fetchAll(PDO::FETCH_ASSOC);//返回取得所有结果，返回关联数组
    }

    /**
     * 预处理方式执行SQL
     * @param $sql string 执行SQL语句
     * @param $data array 数据数组
     * @param &$flag bool 是否执行成功
     * @return object PDOStatement
     */
    public function execute($sql,$data,&$flag=true) {
        $stmt = $this->db->prepare($sql);
        $flag = $stmt->execute($data);
        return $stmt;
    }
}