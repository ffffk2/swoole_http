<?php 

namespace core\pool;

class Pool{

	private static $pool = [];

	# 获取池对象
	public static function getPool($name){
		if (array_key_exists($name, self::$pool)) {
			return self::$pool[$name];
		}else{
			return_exit($name.'连接池不存在');
		}
	}

	# 设置池对象
	public static function setPool($name, $obj){
		self::$pool[$name] = $obj;
	}

	# 获取对象
	public static function getObj($name){
		$pool = self::getPool($name);
		$obj = $pool->get();
		for ($i=0; $obj->connected; $i++) {
			return $obj;
			$obj = $pool->get();
		}
	}

	# 回收对象
	public static function freeObj($name, $obj){
		$pool = self::getPool($name);
		$pool->free($obj);
	}
}