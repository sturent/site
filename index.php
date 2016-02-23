<?php

	session_start();

	include 'bd.php';

	if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
	{
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		$password = stripslashes($password);
		$password = htmlspecialchars($password);
		$u_result = mysql_query("SELECT id, avatar FROM users
					WHERE login='$login' AND password='$password'");
		$myrow = mysql_fetch_array($u_result);
	}



?>

<html>
<head>
	<title>ИЗМЕНЕНИЯ ДЛЯ GIT</title>
	<meta http-equiv="Content-Type" content="text/html"; charset=windows-1251;>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		.welcome{
			position:absolute;
			left: 100px;
		}
		.ava{
			position: absolute;
			left: 25px;
		}
		.exit{
			position: absolute;
			left: 100px;
			bottom: 25px;
		}
		.predel{
			float:left;
			margin-right: 25px;
			border: 1px solid #cdcdcd;
			background-color: #e7e7e7;
			border-radius: 5px;
			width: 250px;
			height: 300px;
		}
		.news{
			text-align: center;
			
		}
		.news a{
			color:black;
		}
		.news2{
			padding-left: 10px;
			padding-right: 10px;
			font-size: 10px;
		}
		.news2 a{
			color:black;
		}

	</style>
</head>

<body>
	<div class="wrapper">
		<div class="header">
			<a href="index.php"><img id="logo" src="images/logo.png" width="209" height="83"></a>
		</div>
<?php
	if (!isset($myrow['id']) or $myrow['id'] == '')
	{
		print <<< HERE
			<div class="left">
				<form    action="testreg.php" method="post">
              <p>
                <label>Ваш логин:<br></label>
                <input    name="login" type="text" size="15"    maxlength="15">
                </p> 
HERE;
		if (isset($_COOKIE['login']))
		{
			//echo 'value='.$_COOKIE['login'];
		}
			print <<<HERE
              <p>
                <label>Ваш пароль:<br></label>
                <input    name="password" type="password" size="15"    maxlength="15">
               </p>
HERE;
		if (isset($_COOKIE['password']))
		{
			//echo 'value='.$_COOKIE['password'];
		}
		print <<< HERE
            <p><input    name="autovhod" type="checkbox" value='1'>Запомнить меня</p>
              <input    type="submit" name="submit" value="Войти">
              <a    href="registration.php">Регистрация</a><br />
              <a href="send_pass.php">Забыли пароль?</a>
              </form>
HERE;
	}
	else
	{
		$id = $_GET['id'];
		print <<< HERE
		<div class="left">
		<br />
			Добро пожаловать, <br /><br />
		<div class="welcome">	
			<a href="profile.php?id=$_SESSION[id]">$_SESSION[login]<br /><br />
		</div>
		<div class="ava">
			<img alt='аватар' src='$myrow[avatar]' width='50' height='50'><br />
		</div>
		<div class="exit">
			<a    href="exit.php">Выход</a>
		</div> 
HERE;
	}

	?>
			</div>

		<div style="clear:both"></div>
				<ul class="top_menu">
						<a href="index.php"><li>Главная</li></a>
						<a href="articles.php"><li>Новости</li></a>
						<a href="portfolio.php"><li>Портфолио</li></a>
						<a href="contacts.php"><li>Контакты</li></a>
						<div class="search">
							<form name="search" method="post" action="search.php">
	   					    <input type="search" name="query" placeholder="Поиск">
	    					<button type="submit" name="srch">Найти</button> 
							</form>
						</div>
				</ul>
			
		<div class="content">
			<div class="page">
				<div class="predel">
					<div class="news">
						<h3><a href="articles.php">Новости</a></h3>
					</div>
					<div class="news2">
						<?php

							$result = mysql_query("SELECT * FROM news
											ORDER BY id DESC
											LIMIT 0, 3");
							
							while ($row = mysql_fetch_array($result))
							{
								?>
								<br />
								<a href="article.php?id=<?php echo $row['id']?>"><h1><?php echo $row['title']."<br />";?></h1></a><br /><hr />
								<?php
							}
								mysql_close();
						?>
					</div>
				</div>
					<div class="text">
						<h2>НОвое изменение</h2>
						
						
					</div>
				
				<div style="clear:both"></div>
			</div>

			<div style="clear:both"></div>
		</div>

		<div class="footer">
			<img src="images/footer.png" width="970"><br />
			Ромкина верстка решает
		</div>
	</div>
</body>
</html>