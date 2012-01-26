<?
class Event extends Base {
	
	public static $table = 'events';
	
	public function getStartTime() 
	{
		return date("g:i A", strtotime($this->start_time));
	}
	
	public function getEndTime() 
	{
		return date("g:i A", strtotime($this->end_time));
	}
	
	public function getDate() 
	{
		return date("l, F jS, Y", strtotime($this->start_time));
	}
	
	public function user()
	{
		return $this->belongs_to('User');
	}

    public function isoFormat($date, $time)
    {
        return date('Y-m-d', strtotime($date)).'T'.date('H:i:s', $time);
    }

    public function postToGCal()
    {
        require_once dirname(__FILE__).'/../../packages/google-api/apiClient.php';
        require_once dirname(__FILE__).'/../../packages/google-api/contrib/apiCalendarService.php';
        $client = new Google\apiClient();
        $client->setApplicationName("WiCS Admin");
        $client->setClientId('96433116372-r9pdi7tgbe2d73g8ob30rt4pqvhvsotu.apps.googleusercontent.com');
        $client->setClientSecret('Fj78WkWA2t4PzcbntMcaFEAr');
        $client->setRedirectUri('http://localhost/admin/events/create');

        $client->setAccessToken($client->refreshToken(Auth::user()->google_token));

        if ($client->getAccessToken()) {
            $service = new Google\apiCalendarService($client);
            $event = new Google\Event();
            $event->setSummary($this->name);
            $event->setLocation($this->location);
            $start = new Google\EventDateTime();
            $start->setDateTime($this->start_time);
            $event->setStart($start);
            $end = new Google\EventDateTime();
            $end->setDateTime($this->end_time);
            $event->setEnd($end);
            $createdEvent = $service->events->insert('rtsh97itkt43ii50vur9sd9f7k@group.calendar.google.com', $event);
            return $createdEvent->getId();

        } else {
            $authUrl = $client->createAuthUrl();
            print "<a class='login' href='$authUrl'>Connect Me!</a>";
            return false;
        }

    }
}
