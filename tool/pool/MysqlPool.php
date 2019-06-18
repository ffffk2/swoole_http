<?php 

namespace tool\pool;

use core\pool\PoolAbstract;

class MysqlPool extends PoolAbstract{

	public function create_obj(){
		$mysql = new \Swoole\Coroutine\MySQL();
		$mysql->connect(config('mysql'));
		return $mysql;
	}
}
