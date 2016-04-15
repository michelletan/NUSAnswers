function login() {
  FB.login(function(response) {
    if (response.status === 'connected') {
      $("#non-login-view").hide();
      $(".login-view").show();
      FB.api('/me', function(response) {
      //  console.log('Successful login for: ' + response.name);
        document.getElementById('username').innerHTML = response.name + "<span class=\"caret\"></span>";
        $.ajax({
          url: '/api/login/facebook',
          method: 'POST'
        });
      });
    }
  }, {scope: 'email'});
}

function logout() {
  FB.logout(function(response) {
    $.ajax({
      url: '/api/logout/facebook',
      method: 'POST'
    });
    window.location = "/"
  }, {scope: 'email'});
}

function share(url) {
  var shareLink = 'http://www.nusanswers.me' + url;
  FB.ui({
    method: 'share',
    href: shareLink
  }, function(response) {
    document.getElementById("share").innerHTML = "Shared!";
  });
}

window.fbAsyncInit = function() {
  var applicationId = "";
  if(window.location.host == "nusanswers.me" || window.location.host == "www.nusanswers.me") {
    applicationId = '581406865343052';
  } else {
    applicationId = '1581294052181728';
  }
	FB.init({
	appId      : applicationId, // CREATE AND INSERT OWN APP ID TO TEST!
  //appId      : '1742198345993041',
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
        $.ajax({
          url: '/api/login/facebook',
          method: 'POST'
        });
      });
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      // console.log("bye");
      $.ajax({
        url: '/api/logout/facebook',
        method: 'POST'
      });
      $("#non-login-view").show();
      $(".login-view").hide();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      // console.log("bye");
      $.ajax({
        url: '/api/logout/facebook',
        method: 'POST'
      });
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
	js.src = "//connect.facebook.net/en_US/all.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
