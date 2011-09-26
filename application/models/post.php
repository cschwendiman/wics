<?
class Post extends Base {
	
	public static $table = 'posts';
	public static $timestamps = true;

	public function getCreatedDate()
	{
		return $this->created_at;
	}
	
	public function getUpdatedDate()
	{
		return $this->updated_at;
	}

	public function user()
	{
		return $this->belongs_to('User');
	}
	
	public function event()
	{
		return $this->belongs_to('Event');
	}
	
}