<?php
include('settings.php');
include('bot_lib.php');
if(login($connect)){
	$text = login($connect);
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Gstrategy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-secret"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Войти в систему</h3>
				  <span style="color:red;">
				  <?php
				  if (isset($text)) {
					echo $text;
				  }
				 ?>
				 </span>
			   <form action="index.php" class="login-form" method="POST">
		      		<div class="form-group">
		      			<input type="text" name="username" class="form-control rounded-left" placeholder="Логин" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name="pass" class="form-control rounded-left" placeholder="Пароль" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="submit_log" class="form-control btn btn-primary rounded submit px-3">логин</button>
	            </div>

	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>

