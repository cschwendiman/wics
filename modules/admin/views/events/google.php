
<!--Add a button for the user to click to initiate auth sequence -->
    <button id="authorize-button" style="visibility: hidden">Authorize</button>
    <script type="text/javascript">
      var clientId = '96433116372-r9pdi7tgbe2d73g8ob30rt4pqvhvsotu.apps.googleusercontent.com';
      var apiKey = 'AIzaSyDpVBx1w2PIfGatnJu-IIMTInpcfdw0EMw';
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
                "description": "<?= $e->description; ?>",
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
          request.execute(function(response) {
            var google_id = response.id;
          });
        });
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>


<!--- FACEBOOK --->

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '218804048182093', // App ID
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
    FB.Flash.hasMinVersion = function () { return false; };
    FB.login(function(response) {
    if (response.authResponse) {
        FB.api('/wicschicks/events', 'post',
        {
            name: "<?= $e->name ?>",
            location: "<?= $e->location ?>",
            description: "<?= $e->description; ?>",
            start_time: "<?= $e->start_time ?>",
            end_time: "<?= $e->end_time ?>",
            page_id: "127971027235949"
        },
        function(response) {
            var facebook_id = response.id;
        });
    } else {
        console.log('User cancelled login or did not fully authorize.');
    }
    }, {scope: 'manage_pages,create_event'});
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
</script>