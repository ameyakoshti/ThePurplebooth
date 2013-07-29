var clientId = '682967959960-p258mukbuo6ijg2jce8ggjjmb0v48f3b.apps.googleusercontent.com';
var apiKey = 'AIzaSyDZK2TYRjLqK-lOX-ALkUJd8276FUEPPxw';
var scopes = 'https://www.googleapis.com/auth/plus.me';

function signinCallback(authResult) {
	gapi.client.setApiKey(apiKey);
  if (authResult['access_token']) {
    // Successfully authorized
    // Hide the sign-in button now that the user is authorized, for example:
	  gapi.auth.setToken(authResult);
    document.getElementById('signinButton').setAttribute('style', 'display: none');
	getUserName();
  } else if (authResult['error']) {
    // There was an error.
    // Possible error codes:
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    // console.log('There was an error: ' + authResult['error']);
  }
}

function getUserName() {
	gapi.client.load('plus', 'v1', function() {
		var request = gapi.client.plus.people.get({
            'userId': 'me'
          });
        request.execute(getUserNameCallback);
      });
}

function getUserNameCallback(obj){
	$('#googleplus').append('<div class="g-person" data-width="338" data-layout="landscape" data-href="//plus.google.com/'+obj.id+'" data-rel="author"></div>');
	gapi.person.go();
}

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();