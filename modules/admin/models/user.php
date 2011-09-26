<?
class User extends Base {
	
	public static $table = 'users';

	public function __construct($arr = array()){
		foreach($arr as $key => $val){
			$this->$key = $val;
		}
	}

	public function getName()
	{
		return "{$this->first_name} {$this->last_name}";
	}
	
}