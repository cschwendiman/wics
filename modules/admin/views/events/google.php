<?php

if(isset($_GET['facebook_id']) && isset($_GET['google_id'])) {
    $event = Event::find(Event::max('id'));
    $event->facebook_id = $_GET['facebook_id'];
    $event->google_id = $_GET['google_id'];
    $event->save();
    echo "Facebook and Google ids updated!";
} else { ?>

<script type="text/javascript">
    var google_id = "";
    var facebook_id = "";
    // -----------------------
    // -       GOOGLE        -
    //------------------------
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
            deleteGoogleEvent();
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
    function createGoogleEvent() {
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
                if (!response || response.error) {
                    console.log('Error occured while creating Google event.');
                } else {
                    console.log('Google event created with id ' + response.id + '.');
                    google_id = response.id;
                    storeIds();
                }
            });
        });
    }

    function deleteGoogleEvent() {
        <? if($e->google_id != null) { ?>
        gapi.client.load('calendar', 'v3', function() {
            var request = gapi.client.request({
                'path': '/calendar/v3/calendars/rtsh97itkt43ii50vur9sd9f7k@group.calendar.google.com/events/<?= $e->google_id ?>',
                'method': 'DELETE'
            });
            request.execute(function(response) {
                console.log('Google event deleted.');
            });
        });
        <? } ?>
    }

    function updateGoogleEvent() {
        <? if($e->google_id != null) { ?>
        gapi.client.load('calendar', 'v3', function() {
            var request = gapi.client.request({
            'path': '/calendar/v3/calendars/rtsh97itkt43ii50vur9sd9f7k@group.calendar.google.com/events/<?= $e->google_id ?>',
            'method': 'PUT',
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
                if (!response || response.error) {
                    console.log('Error occured while updating Google event.');
                } else {
                    console.log('Google event updated.');
                }
            });
        });
        <? } ?>
    }

    // -----------------------
    // -      FACEBOOK       -
    //------------------------
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '218804048182093', // App ID
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
        });

        FB.Flash.hasMinVersion = function () { return false; };
        FB.login(function(response) {
        if (response.authResponse) {
            deleteFacebookEvent();
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
        }, {scope: 'manage_pages,create_event'});
    };

    function createFacebookEvent() {
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
            if (!response || response.error) {
                console.log('Error occured while creating Facebook event: ' + response.error.message);
                console.log(response);
            } else {
                console.log('Facebook Event created with id ' + response.id + '.');
                facebook_id = response.id;
                storeIds();
            }
        });
    }

    function deleteFacebookEvent() {
        <? if($e->facebook_id != null) { ?>
        FB.api('/<?= $e->facebook_id ?>', 'delete',
        function(response) {
            if (!response || response.error) {
                console.log('Error occured while deleting Facebook event');
            } else {
                console.log('Facebook event deleted.');
            }
        });
        <? } ?>
    }

    function updateFacebookEvent() {
        <? if($e->facebook_id != null) { ?>
        FB.api('/<?= $e->facebook_id ?>/events', 'post',
        {
            name: "<?= $e->name ?>",
            location: "<?= $e->location ?>",
            description: "<?= $e->description; ?>",
            start_time: "<?= $e->start_time ?>",
            end_time: "<?= $e->end_time ?>",
            page_id: "127971027235949"
        },
        function(response) {
            if (!response || response.error) {
                console.log('Error occured while updating Facebook event.');
            } else {
                console.log('Facebook event updated.');
            }
        });
        <? } ?>
    }

    // Load the SDK Asynchronously
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));


    // Send facebook_id and google_id to php database
    function storeIds() {
        if(facebook_id != "" && google_id != "")
            location.href="/admin/events/google?facebook_id="+facebook_id+"&google_id="+google_id;
    }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>

    <div id="fb-root"></div>
    <button id="authorize-button" style="visibility: hidden">Authorize</button>
    <? } ?>