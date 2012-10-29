 <?php
   require 'server/fb-php-sdk/facebook.php';

   $app_id = '489544717743967';
   $app_secret = 'd6de77586ac1b7a31051acc31e8b785d';
   $app_namespace = 'test_jfm_dev';
   $app_url = 'https://apps.facebook.com/' . $app_namespace . '/';
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
 ?>

<html>
<head>
	<title>JFM Test App</title>

	<meta http-equiv="Content-Type" contents="text/html; charset=utf-8" />
	<link href="client/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<p style="color: yellow;">TEST2</p>
</body>
</html>
