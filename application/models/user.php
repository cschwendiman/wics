<?
class User extends Base {
	
	public static $table = 'users';

	public function getName()
	{
		return "{$this->first_name} {$this->last_name}";
	}
	
}