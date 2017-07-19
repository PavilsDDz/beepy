<?php

	$texts_haeder = [];

	$texts_haeder['lv'] = [];
	$texts_haeder['en'] = [];
	$texts_haeder['ru'] = [];

	$texts_haeder['lv']['buy'] = 'pirkt';
	$texts_haeder['lv']['sell'] = 'pārdot';
	$texts_haeder['lv']['contacts'] = 'kontakti';
	$texts_haeder['lv']['hello'] = 'Sveiki';
	$texts_haeder['lv']['logout'] = 'iziet';
	$texts_haeder['lv']['signup'] = 'reģistrēties';
	$texts_haeder['lv']['login'] = 'ienākt';

	$texts_haeder['en']['buy'] = 'buy';
	$texts_haeder['en']['sell'] = 'sell';
	$texts_haeder['en']['contacts'] = 'contacts';
	$texts_haeder['en']['hello'] = 'Hello';
	$texts_haeder['en']['logout'] = 'logout';
	$texts_haeder['en']['signup'] = 'signup';
	$texts_haeder['en']['login'] = 'login';

	$texts_haeder['ru']['buy'] = 'купить';
	$texts_haeder['ru']['sell'] = 'продать';
	$texts_haeder['ru']['contacts'] = 'контакты';
	$texts_haeder['ru']['hello'] = 'Привет';
	$texts_haeder['ru']['logout'] = 'выйти';
	$texts_haeder['ru']['signup'] = 'зарегистрироться';
	$texts_haeder['ru']['login'] = 'войти';

 ?>

<div class="top_wrap">	
	<div class="user_profile flex">
		<div class="header_logo">
		    <a href="index.php"><img src="img/logo_b.png" ></a>
		</div>
		<div class="nav">
		    <ul class="links">
		        <ul>
					<li class="flex">
						<a href="searching.php"><?php echo $texts_haeder[$lang]['buy'] ?></a>
						<a href="addcar.php"><?php echo $texts_haeder[$lang]['sell'] ?></a>
						<a href="contacts.php"><?php echo $texts_haeder[$lang]['contacts'] ?></a>
					</li>
		        </ul>
		    </ul>
		</div>
		<div class="language">
			<script type="text/javascript">
				$(function(){
					$(".langbutt").click(function(){
						$(".lang_select").slideToggle(400)
					})
				})
			</script>
			<div class="langbutt"><span><?php if ($lang == 'en') {echo 'english';}else if ($lang == 'lv') {echo 'latviski';}else if($lang == 'ru') {echo 'на Русском';} ?></span></div>
			<form action="" method="GET" class="lang_select">
				<?php if ($lang!= 'en') {?>
				<button type="submit" name="lang" value="en">english</button>
				<?php } ?>
				<?php if ($lang!= 'lv') {?>
				<button type="submit" name="lang" value="lv">latviski</button>
				<?php } ?>
				<?php if ($lang!= 'ru') {?>
				<button type="submit" name="lang" value="ru">на Русском</button>
				<?php } ?>
<<<<<<< HEAD
=======
				<?php if (isset($_GET['id'])&&!empty($_GET['id'])) { ?>
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<?php } ?>
				<?php if (isset($_GET['idc'])&&!empty($_GET['idc'])) {
					$idc = $_GET['idc'];
					foreach($idc as $index){ ?>
					<input type="hidden" name="idc[]" value="<?php echo $index; ?>">

					<?php }
				 } ?>
>>>>>>> fe32f42be224787e5650aba491d3692858e37e6b
			</form>
		</div>
		<div class="acount_manage flex">
	<?php 
		if (isset($_SESSION['uid'])) {
			$Q = "SELECT firstname FROM users WHERE id=:id";
			$P['id'] = $_SESSION['uid'];
			$name = getDataFromDatabase($Q,$P);
			?> 
			<p><?php echo $texts_haeder[$lang]['hello']?><a href="profile.php"><b><?php echo $name['firstname'];?></b></a></p>

			<a href = "index.php?logout"><?php echo $texts_haeder[$lang]['logout'] ?></a>
			 
			 

		<?php
		}else{
			?>

			<a class="signup" href="signup.php"><?php echo $texts_haeder[$lang]['signup'] ?></a>
			<a href="login.php"><?php echo $texts_haeder[$lang]['login'] ?></a>

			<?php } ?>
		</div>
		

	</div>

	



</div>
<link rel="stylesheet" type="text/css" href="css/default.css">

