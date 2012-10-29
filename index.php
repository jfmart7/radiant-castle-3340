<?php
/**
* Copyright 2012 Facebook, Inc.
*
* You are hereby granted a non-exclusive, worldwide, royalty-free license to
* use, copy, modify, and distribute this software in source code or binary
* form for use in connection with the web services and APIs provided by
* Facebook.
*
* As with any software that integrates with the Facebook platform, your use
* of this software is subject to the Facebook Developer Principles and
* Policies [http://developers.facebook.com/policy/]. This copyright notice
* shall be included in all copies or substantial portions of the software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
* THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
* DEALINGS IN THE SOFTWARE.
*/

  require 'server/fb-php-sdk/facebook.php';

   $app_id = '489544717743967';
   $app_secret = 'd6de77586ac1b7a31051acc31e8b785d';
   $app_namespace = 'test_jfm_dev';
  $app_url = 'http://apps.facebook.com/' . $app_namespace . '/';
  $scope = 'email,publish_actions';

  // Init the Facebook SDK
  $facebook = new Facebook(array(
    'appId'  => $app_id,
    'secret' => $app_secret,
  ));

  // Get the current user
  $user = $facebook->getUser();

  // If the user has not installed the app, redirect them to the Auth Dialog
  if (!$user) {
    $loginUrl = $facebook->getLoginUrl(array(
      'scope' => $scope,
      'redirect_uri' => $app_url,
    ));

    print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
  }

  if(isset($_REQUEST['request_ids'])) {
    $requestIDs = explode(',' , $_REQUEST['request_ids']);
    foreach($requestIDs as $requestID) {
      try {
        $delete_success = $facebook->api('/' . $requestID, 'DELETE');
      } catch(FacebookAPIException $e) {
        error_log($e);
      }
    }
  }
?>

<!DOCTYPE html>

<html>
<head>
  <title>Critical Mass</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta property="og:image" content="http://www.mattwkelly.com/html5/critical-mass/critical_mass.png"/>

  <link href="client/style.css" rel="stylesheet" type="text/css">
  <link rel="apple-touch-icon" href="http://www.mattwkelly.com/html5/critical-mass/critical_mass.png" />
</head>
<body ontouchmove="BlockMove(event);">
<p style="color=yellow;">update workeddddd!</p><br/>
 <div id="fb-root"></div>
  <script src="//connect.facebook.net/en_US/all.js"></script>

  <div id="stage">
    <div id="gameboard">
      <canvas id="myCanvas"></canvas>
    </div>
  </div>

  <!--<script src="client/core.js"></script>
  <script src="client/game.js"></script>
  <script src="client/ui.js"></script>
  <script src="http://code.jquery.com/jquery-1.5.min.js"></script>
-->
  <script>
    var appId = '<?php echo $facebook->getAppID() ?>';

    // Initialize the JS SDK
    FB.init({
      appId: appId,
      cookie: true,
    });

    FB.getLoginStatus(function(response) {
      uid = response.authResponse.userID ? response.authResponse.userID : null;
      document.write('<p style="color=red;">UID: ' + uid + '</p><br/>');

   // FB.api('/me/friends?limit=5', function(response) {
//	if(response.data) {
//		$.each(response.data,function(index,friend) {
//			document.write('<p>' + friend.name + ' : ' + friend.id + '</p><br/>');
//		});
//	} else {
//		document.write('<p>Couldn't get friends list</p><br/>');
//	}
//   });
    });
  </script> 

</body>
</html>
