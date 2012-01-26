<?
class User extends Base {
	
	public static $table = 'users';

	public function getName()
	{
		return "{$this->first_name} {$this->last_name}";
	}
	
	public function getClearance()
	{
			$result =  DB::query('select min(roles.clearance) as clearance from users, roles, users_roles where users.id = users_roles.user_id and roles.id = users_roles.role_id and roles.active = 1 and users.id = ?',
			array($this->id));
			return array_shift($result)->clearance + 0;
	}
	
	public function roles()
	{
		return $this->has_and_belongs_to_many('Role', 'users_roles');
	}
	
}