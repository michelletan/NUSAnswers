function login() {
  FB.login(function(response) {
    if (response.status === 'connected') {
      $("#non-login-view").hide();
      $(".login-view").show();
      FB.api('/me', function(response) {
      //  console.log('Successful login for: ' + response.name);
        document.getElementById('username').innerHTML = response.name + "<span class=\"caret\"></span>";
      });
    }
  }, {scope: 'email'});
}

function logout() {
  FB.logout(function(response) {
    $("#non-login-view").show();
    $(".login-view").hide();
  }, {scope: 'email'});
}

/*function share() {
  FB.ui({
    method: 'share',
    href: '[URL]',
  }, function(response) {});
} */

window.fbAsyncInit = function() {
	FB.init({
	appId      : '581406865343052', // CREATE AND INSERT OWN APP ID TO TEST!
	cookie     : true,  // enable cookies to allow the server to access 
	                    // the session
  status     : true,
	xfbml      : true,  // parse social plugins on this page
	version    : 'v2.5' // use any version
});

  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      // console.log("hi");
      $("#non-login-view").hide();
      $(".login-view").show();
      FB.api('/me', function(response) {
      //  console.log('Successful login for: ' + response.name);
        document.getElementById('username').innerHTML = response.name + "<span class=\"caret\"></span>";
      });
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      // console.log("bye");
      $("#non-login-view").show();
      $(".login-view").hide();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      // console.log("bye");
      $("#non-login-view").show();
      $(".login-view").hide();
    }
  });
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));