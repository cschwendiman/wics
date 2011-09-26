<?
class Event extends Base {
	
	public static $table = 'events';
	
	public function getStartTime() 
	{
		return date("g:i A", $this->start_time);
	}
	
	public function getEndTime() 
	{
		return date("g:i A", $this->end_time);
	}
	
	public function getDate() 
	{
		return date("l, F jS, Y", $this->start_time);
	}
	
	public function user()
	{
		return $this->belongs_to('User');
	}
	
}
