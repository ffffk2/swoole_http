<?php 

namespace core\pool;

abstract class PoolAbstract{
	
	private $config = ['max' => 100, 'min' => 20];
	
	private $chan;
	
	private $num = 0;
	
	public function __construct($config = []){
		$this->config = array_merge($this->config, $config);
		$this->chan = new \Swoole\Coroutine\Channel($this->config['max']);
		for($i=0;$i<$this->config['min'];$i++){
			$obj = $this->create_obj();
			if (!$obj->connected) {
				throw new \Swoole\ExitException('连接池连接出错');
			}
			$this->chan->push($obj);
			$this->num++;
		}
	}
	
	# 修改配置
	public function set($arr = []){
		foreach($arr as $key => $value){
			$this->config[$key] = $value;
		}
	}
	
	# 实例化对象
	abstract function create_obj();
	
	# 获取对象
	public function get(){
		$this->num--;
		if($this->num < $this->config['min']){
			$obj = $this->create_obj();
		}else{
			$obj = $this->chan->pop(2);
		}
        return $obj;
		
	}
	
	# 回收对象
	public function free($obj){
		if($this->num >= $this->config['max']){
			return true;
		}else{
			$res = $this->chan->push($obj, 2);
			$this->num++;
			return $res;
		}
	}
}