<main>
	<?php 
	$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING); 
	$pas = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
	$pas=md5($pas."lsdfk12546");
	// var_dump($_POST);
	if (mb_strlen($login)<1 || mb_strlen($login)>90) {
	echo "Недопустимая длина логина";
	exit();
	}elseif (mb_strlen($pas)<5 || mb_strlen($pas)>100) {
	echo "Недопустимая длина пароля";
	exit();
}
// Подкл к БД
	$mysql = new mysqli('localhost','root','','green_card');
	$mysql -> query ("SET NAMES 'utf8'");
	if (!$mysql) {
	die('Ошибка соединения'.mysqli_connect_errno());
}
	// $mysql -> query ("INSERT INTO `reg-users`(`login`, `email`, `password`) VALUES ('$login', '$email', '$pas')");


	$result = $mysql -> query("SELECT * FROM `reg-users`WHERE `login`='$login'AND `password`='$pas'");
	$user=$result->fetch_assoc();
	print_r($user['login']);
	if (count($user)==0) {
		echo "Вы не авторизовались";
		header('location: page.php?id=sign');
	} else{
		echo "Вы авторизовались";
	}

	
	// var_dump($_COOKIE['iser']);

	$mysql->close();
	 ?>

   <fieldset>
  	<form action="../page.php?id=users-page" method="post" class="subform">
    <div class="f-logo"></div>
    <div class="f-header">
    	<h3>Войти</h3>
    	<span class="registr"><a href="../page.php?id=registration">Регистрация</a></span>
    </div>
    <div class="f-usern">
	<p>
		<label for="login">Введите логин</label>
		<input type="text" class="f-control" name="login" id="login">
	</p>
    </div>
    <div class="f-usern">
	<p>
		<label for="password">Введите password</label>
		<input type="password" class="f-control" name="password" id="password">
	</p>
  <p>
    <input type="submit" value="Авторизация">
  </p>
    </div>
    </form>
    
  </fieldset>


</main>