<?php
namespace Code;

class PdoMysql{
    public $link;

    public function __construct()
    {
        $db = array(
            'host' => '127.0.0.1',         //设置服务器地址
            'port' => '3306',              //设端口
            'dbname' => 'test',             //设置数据库名
            'username' => 'test',           //设置账号
            'password' => 'test',      //设置密码
            'charset' => 'utf8',             //设置编码格式
            'dsn' => 'mysql:host=127.0.0.1;dbname=test;port=3306;charset=utf8',   //这里不知道为什么，也需要这样再写一遍。
        );

        if(!$this->link){
            //TODO 连接重连问题
            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //默认是PDO::ERRMODE_SILENT, 0, (忽略错误模式)
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // 默认是PDO::FETCH_BOTH, 4
            );

            try{
                $pdo = new \PDO($db['dsn'], $db['username'], $db['password'], $options);
            }catch(\PDOException $e){
                die('数据库连接失败:' . $e->getMessage());
            }

            $this->link = $pdo;
        }
    }

    public function query($sql)
    {
        $stmt = $this->link->query($sql); //返回一个PDOStatement对象

        //$row = $stmt->fetch(); //从结果集中获取下一行，用于while循环
        $rows = $stmt->fetchAll(); //获取所有
        return $rows;
//        $row_count = $stmt->rowCount(); //记录数，2
//        print_r($rows);
    }


    public function find($sql){
        $stmt = $this->link->query($sql); //返回一个PDOStatement对象

        //$row = $stmt->fetch(); //从结果集中获取下一行，用于while循环
        $rows = $stmt->fetch(); //获取所有
        return $rows;
    }

    public function select_all()
    {

    }

    public function crud($sql)
    {
        $count  =  $this->link->exec($sql); //返回受影响的行数

        return $count;
    }

    public function insert()
    {
        //todo
    }
}