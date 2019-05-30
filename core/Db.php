<?php 

namespace core;

use core\pool\Pool;

class Db{

	protected $mysql = null;

	protected $name = '';

	protected $table = '';

	protected $where = '';

	protected $order = '';

	protected $group = '';

	protected $field = '';

	protected $join = [];

	protected $limit = '';

	protected $sql = '';

    protected $pk = 'id';

    protected static $prefix = '';

	public function __construct($name = 'mysql'){
		// 获取连接池对象
		$this->mysql = Pool::getObj($name);
        self::$prefix = config('mysql.prefix');
	}

    public static function name($table){
        // 实例化对象
        $obj = new Db();
        $obj->table = self::$prefix . $table;
        return $obj;
    }

	public function insert($data){
	    $field = implode(',', array_keys($data));
	    $value = array_values($data);
        foreach ($value as &$item) {
            $item = "'{$item}'";
	    }
	    $value = implode(',', $value);
        $sql = 'insert into ' . $this->table . ' (' . $field . ') value (' . $value . ')';
        $res = $this->mysql->query($sql);
        return $this->result($res);
	}

	public function insertGetId($data){
	    $res = $this->insert($data);
	    if ($res){
	        $id = $this->order($this->pk . ' desc')->find();
	        return $id[$this->pk];
	    }else{
	        return $res;
        }
	}

	public function update($data){
        $field = array_keys($data);
        $value = array_values($data);
        $data_arr = [];
        foreach ($value as $index => $item) {
            $data_arr[] = "`{$field[$index]}` = '{$item}'";
        }
        $data_str = implode(',', $data_arr);
        $sql = 'update `' . $this->table . '` set ' . $data_str . ' where ' . $this->where;
        $res = $this->mysql->query($sql);
        return $this->result($res);
	}

	public function delete(){

	}

	public function find(){
        $sql = 'select';
        if ($this->field){
           $sql .= ' ' . $this->field . ' from `' . $this->table . '`';
        }else{
            $sql .= ' * from `' . $this->table . '`';
        }
        if ($this->name){
            $sql .= ' as ' . $this->name;
        }
        if ($this->join){
            foreach ($this->join as $join) {
                $sql .= ' '.$join;
            }
        }
        if ($this->where){
            $sql .= ' where ' . $this->where;
        }
        if ($this->group){
            $sql .= ' group by ' . $this->group;
        }
        if ($this->order){
            $sql .= ' order by ' . $this->order;
        }
        $sql .= ' limit 1';
        $this->sql = $sql;
        $res = $this->mysql->query($sql);
        if ($res!==false){
            if (!empty($res)){
                return $res[0];
            }else{
                return $res;
            }
        }else{
            throw new \Swoole\ExitException($this->mysql->error.PHP_EOL.' sql:'.$this->sql);
        }
	}

	public function select(){
        $sql = 'select';
        if ($this->field){
            $sql .= ' ' . $this->field . ' from ' . $this->table;
        }else{
            $sql .= ' * from `' . $this->table . '`';
        }
        if ($this->name){
            $sql .= ' as ' . $this->name;
        }
        if ($this->join){
            foreach ($this->join as $join) {
                $sql .= ' ' . $join;
            }
        }
        if ($this->where){
            $sql .= ' where ' . $this->where;
        }
        if ($this->group){
            $sql .= ' group by ' . $this->group;
        }
        if ($this->order){
            $sql .= ' order by ' . $this->order;
        }
        if ($this->limit){
            $sql .= ' limit ' . $this->limit;
        }
        $this->sql = $sql;
        $res = $this->mysql->query($sql);
        return $this->result($res);
	}

    public function count(){
        
        $sql = 'select';
        $sql .= ' count(*) as count from `' . $this->table . '`';
        if ($this->name){
            $sql .= ' as ' . $this->name;
        }
        if ($this->join){
            foreach ($this->join as $join) {
                $sql .= ' ' . $join;
            }
        }
        if ($this->where){
            $sql .= ' where ' . $this->where;
        }
        if ($this->group){
            $sql .= ' group by ' . $this->group;
        }
        if ($this->limit){
            $sql .= ' limit ' . $this->limit;
        }
        $this->sql = $sql;
        $res = $this->mysql->query($sql);
        if ($res) {
            $res = $res[0]['count'];
        }
        return $this->result($res);
    }

	public function where($where){
        if (is_array($where)){
            $where_arr = [];
            foreach ($where as $key => $value) {
                $key = explode('.', $key);
                foreach ($key as &$k) {
                    $k = '`'.trim($k).'`';
                }
                $key = implode('.', $key);
                if (is_array($value)){
                    if ($value[0] == 'in' && is_string($value[1])){
                        $where_arr[] = "{$key} {$value[0]} ({$value[1]})";
                    }else if($value[0] == 'in' && is_array($value[1])){
                        $value[1] = implode(',', $value[1]);
                        $where_arr[] = "{$key} {$value[0]} ({$value[1]})";
                    }else{
                        $where_arr[] = "{$key} {$value[0]} '{$value[1]}'";
                    }
                }else{
                    $where_arr[] = "{$key} = '{$value}'";
                }
            }
            $this->where = implode(' and ', $where_arr);
        }else{
            $this->where = $where;
        }
        return $this;
	}

	public function alias($name){
	    $this->name = $name;
	    return $this;
    }

	public function order($order){
        $this->order = $order;
        return $this;
	}

	public function group($group){
        $this->group = $group;
        return $this;
	}

	public function field($field){
        $this->field = $field;
        return $this;
	}

	public function join($table, $on, $type = 'inner'){
        $join = $type . ' join ' . $table . ' on ' . $on;
        $this->join[] = $join;
        return $this;
	}

	public function query($sql){
        $res = $this->mysql->query($sql);
        if ($res){
            return true;
        }else{
            return_msg($this->mysql->error);
        }
	}

	public function limit($limit){
        $this->limit = $limit;
        return $this;
	}

	public function page($page, $size){
        $start = ($page - 1) * $size;
        $this->limit = "{$start}, {$size}";
        return $this;
	}

	public function __destruct(){
	    Pool::freeObj('mysql', $this->mysql);
    }

    public function result($res){
	    if ($res !== false){
	        return $res;
	    }else{
            throw new \Swoole\ExitException($this->mysql->error.PHP_EOL.' sql:'.$this->sql);
        }
    }

    public static function begin(){
        $this->mysql->begin();
    }

    public static function commit(){
        $this->mysql->commit();
    }

    public static function rollback(){
        $this->mysql->rollback();
    }
}