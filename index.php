<html>
	<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.fullscreenr.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,200' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	<title>Login // coold!</title>
	<script type="text/javascript">  
		var FullscreenrOptions = {  width: 1920, height: 1020, bgID: '#bgimg' };
		jQuery.fn.fullscreenr(FullscreenrOptions);
	</script>
	 </head>
 	<body>
 		<img id="bgimg" src="images/bg-login.jpg" />
		<div class="wrapper">
			<div class="content">
				<h1>Login</h1>
				<div class="form">
					<form action="login.php" method="post" autocomplete="off">
						<div class="inputs">
							<i class="icon-user"></i><input type="text" name="username" class="username" placeholder="Enter the Username" tabindex="1"><br/>
							<div class="trenner"></div>
							<i class="icon-lock"></i><input type="password" name="password" class="password" placeholder="Enter the Password" tabindex="2">
						</div>
						<input type="submit" value="Login" class="login" tabindex="3">
					</form>
				</div>
			</div>				
		</div>
	</body>
</html>

