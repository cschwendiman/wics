<?/*require_once dirname(__FILE__).'/../../../../packages/google-api/apiClient.php';
        require_once dirname(__FILE__).'/../../../../packages/google-api/contrib/apiCalendarService.php';
        $client = new Google\apiClient();
        $client->setApplicationName("WiCS Admin");
        $client->setClientId('96433116372-r9pdi7tgbe2d73g8ob30rt4pqvhvsotu.apps.googleusercontent.com');
        $client->setClientSecret('Fj78WkWA2t4PzcbntMcaFEAr');
        $client->setRedirectUri('http://localhost/admin/events/create');


        if (isset($_GET['code'])) {
        $client->authenticate();
        $current_user->google_token = $client->getAccessToken();
        $current_user->save();
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if ($current_user->google_token) {
        $client->setAccessToken($current_user->google_token);
        }

        if ($client->getAccessToken()) {
            $service = new Google\apiCalendarService($client);
            $event = new Google\Event();
            $event->setSummary($e->name);
            $event->setLocation($e->location);
            $start = new Google\EventDateTime();
            $start->setDateTime($e->start_time);
            $event->setStart($start);
            $end = new Google\EventDateTime();
            $end->setDateTime($e->end_time);
            $event->setEnd($end);
            $createdEvent = $service->events->insert('rtsh97itkt43ii50vur9sd9f7k@group.calendar.google.com', $event);

        } else {
            $authUrl = $client->createAuthUrl();
            print "<a class='login' href='$authUrl'>Connect Me!</a>";
        }*/?>
<?= $e->description ?>
<!--Add a button for the user to click to initiate auth sequence -->
    <button id="authorize-button" style="visibility: hidden">Authorize</button>
    <script type="text/javascript">
      // Enter a client ID for a web application from the Google Developer Console.
      // The provided clientId will only work if the sample is run directly from
      // https://google-api-javascript-client.googlecode.com/hg/samples/authSample.html
      // In your Developer Console project, add a JavaScript origin that corresponds to the domain
      // where you will be running the script.
      var clientId = '96433116372-r9pdi7tgbe2d73g8ob30rt4pqvhvsotu.apps.googleusercontent.com';

      // Enter the API key from the Google Develoepr Console - to handle any unauthenticated
      // requests in the code.
      // The provided key works for this sample only when run from
      // https://google-api-javascript-client.googlecode.com/hg/samples/authSample.html
      // To use in your own application, replace this API key with your own.
      var apiKey = 'AIzaSyDpVBx1w2PIfGatnJu-IIMTInpcfdw0EMw';

      // To enter one or more authentication scopes, refer to the documentation for the API.
      var scopes = 'https://www.googleapis.com/auth/calendar';

      // Use a button to handle authentication the first time.
      function handleClientLoad() {
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,1);
      }

      function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
      }


      function handleAuthResult(authResult) {
        var authorizeButton = document.getElementById('authorize-button');
        if (authResult) {
          authorizeButton.style.visibility = 'hidden';
          makeApiCall();
        } else {
          authorizeButton.style.visibility = '';
          authorizeButton.onclick = handleAuthClick;
        }
      }

      function handleAuthClick(event) {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        return false;
      }

      // Load the API and make an API call.  Display the results on the screen.
      function makeApiCall() {
        gapi.client.load('calendar', 'v3', function() {
          var request = gapi.client.request({
            'path': '/calendar/v3/calendars/rtsh97itkt43ii50vur9sd9f7k@group.calendar.google.com/events',
            'method': 'POST',
            'body':
            {
                "summary": "<?= $e->name ?>",
                "location": "<?= $e->location ?>",
                "description": "<?/*= $e->description */?>",
                "start": {
                    "dateTime": "<?= $e->start_time ?>",
                    "timeZone": "US/Central"
                },
                "end": {
                    "dateTime": "<?= $e->end_time ?>",
                    "timeZone": "US/Central"
                }
            }
          });
          request.execute(function(resp) {
            console.log(resp);
          });
        });
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>