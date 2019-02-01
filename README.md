# neptune-php 一个redis连接池客户端

#### 介绍
这是一个php调用grpc服务使用redis连接池的一个客户端封装包；
使用该包你可以快速的连接并使用 [neptune](https://github.com/zhuCheer/neptune)（一个redis连接池服务端） 项目 

#### 环境说明
-  php5.6+
-  安装 grpc 扩展

#### 安装
使用 Composer 包管理
```
composer require cheer/neptune-php
```

#### 使用说明
- 首先需要将 [neptune](https://github.com/zhuCheer/neptune)服务端运行起来；直接到该项目下 Release 里面下载对应编译好的程序；

- 调用示例：
```
require 'vendor/autoload.php';

//redis 连接信息
$option = [
    'ip'=>'192.168.137.100',
    'port'=>'6379',
    //'auth'=>'123456',//没有密码直接忽略
    'db_num'=>5,//需要存储到redis的库编号
    'init_cap'=>10,//初始连接数
    'max_cap'=>50,//最大连接数
    'timeout'=>30,//连接超时时间，超时后会释放连接
];

$server = '192.168.137.1:50033';//grpc服务端绑定ip端口

$client = new \Cheer\NeptuneClient\Client($server, $option);
$registerId = $client->registerPool();//进行连接池注册，注册后得到一个连接池ID，可以保存下来
//$client->setRegisterId($registerId);//如果已经保存了连接池ID直接调用该方法即可，无需重复调用注册方法
$key = "NeptuneClient";
$info = ['id'=>1,'info'=>'Hello World', 'time'=>time()];

$ret = $client->set($key, serialize($info));
```


#### proto生成php类
如果希望对项目进行开发修改proto文件后需要重新生成 proto 类文件；

生成需要安装 proto 和 grpc_php_plugin
然后到项目目录中执行如下命令；
```
protoc --proto_path=./ --php_out=../grpc/ --grpc_out=../grpc/ --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin  redis.proto
```