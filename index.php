<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$_SESSION['test'] = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ремонт компьютеров</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png">
	<link rel="stylesheet" href="style.css" media="all">
	<script src="js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class = "menu">
		<nav id="menushka">
			<ul>
				<li><a href="#services">Наши услуги</a></li>
				<li><a href="#comments">Отзывы</a></li>
				<li><a href="#entry">Запись</a></li>
				<li><a href="#contacts">Контакты</a></li>
			</ul>
		</nav>
	</div>

	<div class = "content">
		<div class = "mid">
			<div class = "fon">
			<div class = "mainblock">
				<h1>PC Doctor<h1>
			</div>
			<section id="services"></section>
				<!-- Услуги -->
				<div class = "block">
					<a href = "#">
						<section class = "anons">
							<img src="images/pic1.png" alt="Настройка сетей">
							<h1>Настройка сетей</h1>
							<p>Настройка сетей любой сложности. Дома, в офисе, на предприятии.</p>
						</section>
					</a>
				</div>
				<div class = "block">
					<a href = "#">
						<section class = "anons">
							<img src="images/pic2.png" alt="Установка ПО">
							<h1>Установка ПО</h1>
							<p>Установка программного обеспечения и подготовка рабочего места сотрудников.</p>
						</section>
					</a>
				</div>
				<div class = "block">
					<a href = "#">
						<section class = "anons">
							<img src="images/pic3.png" alt="Ремонт ПК">
							<h1>Ремонт ПК</h1>
							<p>Диагностика неисправностей и ремонт компьютеров.</p>
						</section>
					</a>
				</div>
				<div class = "block">
					<a href = "#">
						<section class = "anons">
							<img src="images/pic4.png" alt="Ремонт ПК">
							<h1>Подбор конфигурации ПК</h1>
							<p>Подбор конфигурации ПК подходящей для решения ваших задач.</p>
						</section>
					</a>
				</div>
		<!-- Комментарии пользователей -->
				<div class = "block2">
					<section id="comments"></section>
						<h1>Отзывы наших пользователей<h1>
							<div class = "customer">
								<img src="images/nonepic.gif" alt="Наш клиент">
								<h2>Сергей Анатольевич</h2>
								<p>Спасибо вам огромное за хорошее отношение и быстрое устранение поломки компьютера! Буду обращаться и дальше! </p>
							</div>
							<div class = "customer">
								<img src="images/nonepic.gif" alt="Наш клиент">
								<h2>Николай Александрович</h2>
								<p>Думал, в своем немолодом возрасте уже не разберусь в компьютерах, а мастер все так объяснил, что даже я все понял </p>
							</div>
							<div class = "customer">
								<img src="images/nonepic.gif" alt="Наш клиент">
								<h2>Андрей Анатольевич</h2>
								<p>Оперативно и качественно, остался доволен! </p>
							</div>
							<div class = "customer">
								<img src="images/nonepic.gif" alt="Наш клиент">
								<h2>Руслан</h2>
								<p>Фирма в принципе понравилась, очень быстро отреагировали на мое письмо-заявку и пообещали прислать мастера, который оказался хоть и не таким расторопным(опаздал на полтора часа), зато очень вежливым и извинился за свою оплошность. В принципе наверное можно вас рекомендовать знакомым.</p>
							</div>
							<div class = "customer">
								<img src="images/nonepic.gif" alt="Наш клиент">
								<h2>Борис</h2>
								<p>Спасибо за произведенную модернизацию системного блока, игры больше не тормозят даже на высоких настройках графики. Специалист Федор дал множество полезных советов по оптимизации, спасибо ему.</p>
							</div>
				</div>
				<!-- Запись -->
				<div class = "block2">
					<section id="entry"></section>
					<h1>Оставьте заявку, мы обязательно свяжемся с вами!<h1>
						<?php
							require 'php/note.php';
							echo Note::get_form('php/tonote.php','php/shownotes.php','php/showlastnote.php');
							echo $_SESSION['message'];
							$_SESSION['message'] = '';
						?>
				</div>
				<!-- Контакты -->
				<div class = "block2">
					<section id="contacts"></section>
					<h1>Наши контакты<h1>
					<div class = "contact">
						<a href = "https://vk.com/im_rc6">
							<section>
							<img src="images/vk.png" alt="Наш клиент">
							<p>Вконтакте</p>
							</section>
						</a>
					</div>
					<div class = "contact">
						<section>
						<img src="images/gmail.png" alt="Наш клиент">
						<p>Gmail</p>
						</section>
					</div>
				</div>
				<div class = "clear"></div>
			</div>
		</div>
	</div>


	<!-- Подвал -->
	<footer>
		<div class = "mid">
			2016 Лабораторная работа №4 АСУ-15 Пермяков Юрий  
		</div>
	</footer>
</body>
</html>
