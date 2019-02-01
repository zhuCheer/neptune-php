<?php namespace Cheer\NeptuneClient;
/* 
 * @author zhucheer
 * @license MIT
 * @version v1.0.0
 * php调用grpc服务使用redis连接池客户端
 */
use Neptune\NeptunePoolClient;
use Neptune\DoRegistRequest as NeptuneRegistRequest;
use Neptune\DoRequest as NeptuneRequest;
use Neptune\DoReleaseRequest as NeptuneReleaseRequest;

class Client{
    
    private $grpcServer;
    private $option = [
        'ip'=>'',
        'port'=>'',
        'auth'=> '',
        'init_cap'=>5,
        'max_cap'=>30,
        'timeout'=>30,
        'db_num'=>0,
    ];
    private $grpcClient;
    private $registerId;

    public function __construct($grpcServer, $option=[]) {
        $this->grpcServer=$grpcServer;
        $this->grpcClient =  new NeptunePoolClient($grpcServer, ['credentials' => \Grpc\ChannelCredentials::createInsecure()]);
        $this->initOption($option);
    }
    
    /**
     * redis操作触发
     */
    public function __call($name, $arguments) {
        $func = strtolower($name);
        return $this->redisDoFun($func, $arguments);
    }
    
    /**
     * 重新编写hgetall方法返回map
     */
    public function hgetall($arguments){
        $datas = $this->redisDoFun('hgetall', [$arguments]);
        $mapReturn = [];
        for($i=0; $i<count($datas); $i+=2){
            $mapReturn[$datas[$i]] = $datas[$i+1];
        }
        return $mapReturn;
    }
    

    /**
     * 注册一个连接池
     */
    public function registerPool(){
        $client = $this->grpcClient;
        $request = new NeptuneRegistRequest();
        $addr = $this->option['ip'].':'.$this->option['port'];
        
        $request->setAddress($addr);
        $this->option['auth'] && $request->setAuth($this->option['auth']);
        $request->setInitialCap($this->option['init_cap']);
        $request->setMaxCap($this->option['max_cap']);
        $request->setIdleTimeout($this->option['timeout']);
        $request->setDBNum($this->option['db_num']);
        list($reply, $status) = $client->DoRegist($request)->wait();
        $regId = $this->formatResponse($reply, $status);
        $this->registerId = $regId;
        return $regId; 
    }
    
    /**
     * 释放一个连接池
     */
    public function releasePool(){
        $client = $this->grpcClient;
        $request = new NeptuneReleaseRequest();
        $request->setRegistId($this->registerId);
        list($reply, $status) = $client->DoRelease($request)->wait();
        $ret = $this->formatResponse($reply, $status);
        if ($ret == 'success'){
            return true;
        }
        return false;
    }
    
    
    /**
     * 设置一个连接池ID
     */
    public function setRegisterId($registerId){
        $this->registerId = $registerId;
    }
    
    /**
     * 注册ID检测是否存在
     */
    private function registerIdCheck(){
        if(empty($this->registerId)){
            throw new NeptuneException('not found register id, make sure regist pool is ok');
        }
        return true;
    }
 
    /**
     * redis操作调用
     */
    private function redisDoFun($name, $arguments){
        $this->registerIdCheck();
        $client = $this->grpcClient;
        $setParams = json_encode($arguments);
        $request = new NeptuneRequest();
        $request->setRegistId($this->registerId);
        $request->setName($name);
        $request->setParams($setParams);
        list($reply, $status) = $client->DoFun($request)->wait();
        $responseInfo = $this->formatResponse($reply, $status);
        return $responseInfo;
    }


    /**
     * 格式化返回数据
     */
    private function formatResponse($reply, $status){
        if($status->code != 0){
            throw new NeptuneException('grpc response status have an error:'.$status->details);
        }
        $info = json_decode($reply->getResponse(), true);
        if(empty($info)){
            throw new NeptuneException('grpc response info have an error:'.$reply->getResponse());
        }
        if($info['code'] != 0){
            throw new NeptuneException($info['info']. '['.json_encode($info['data']).']');
        }
        return $info['data'];
    }

    /**
     * 初始化配置信息
     */
    private function initOption($option){
        foreach($option as $key => $item){
            if(!empty($option[$key])){
                $this->option[$key] = $option[$key];
            }
        }
        if(empty($this->option['ip']) || empty($this->option['port'])){
            throw new NeptuneException('ip and port must set');
        }
        if($this->option['init_cap'] >=  $this->option['max_cap']){
            throw new NeptuneException('init_cap must lt max_cap');
        }
    }
    
}

