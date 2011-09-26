<?

class Post extends Base {
	
	public static $table = 'posts';
	public static $timestamps = true;

	public function user()
	{
		return $this->belongs_to('User');
	}
	
	public function event()
	{
		return $this->belongs_to('Event');
	}
	
}