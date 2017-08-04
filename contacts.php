<?php
    include ('assets/connect.php');
    include 'assets/setup.php';
?>

<?php 

	$texts=[];
	
	$texts['lv'] = [];
	$texts['en'] = [];
	$texts['ru'] = [];

	$texts['lv']['h1'] = 'Sazinaties ar mums';
	$texts['lv']['subscribe_h2'] = 'Abonējiet ēpastus un saņemiet jaunākās ziņas';
	$texts['lv']['placeholder'] = 'Jūsu ēpasta adresse';
	$texts['lv']['subscribe'] = 'abonēt';
	$texts['lv']['adress'] = 'Ūdens iela 12, Rīga, Latvija';
	

	$texts['en']['h1'] = 'Contact us';
	$texts['en']['subscribe_h2'] = 'Subscribe and get the latest news';
	$texts['en']['placeholder'] = 'Your e-mail adress';
	$texts['en']['subscribe'] = 'subscribe';
	$texts['en']['adress'] = 'Udens iela 12, Riga, Latvia';


	$texts['ru']['h1'] = 'Свяжитесь с нами';
	$texts['ru']['subscribe_h2'] = 'Подписывайтесь на электронную почту и получайте новости';
	$texts['ru']['placeholder'] = 'ваш адрес электроной почты';
	$texts['ru']['subscribe'] = 'подписаться';
	$texts['ru']['adress'] = 'Улица Уденс 12, Рига, Латвия';
	

//nothing

 ?>

<!DOCTYPE html>
<html>
    <head>
    <?php include"assets/head.php" ?>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
    
        


    </head>

	<style>
.header{ 
    background-image: url(img/background4.jpg);
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    height: auto;
    position: relative;
    padding-top: 30px;
}
.table_maps{
	width: 70%;
    margin-top: 4vw;
    margin-left: 14%;
    padding-bottom: 3vw;
}
.table_maps td{
	width: 50%;
}
.list1 th{
	width: 5%;
}
.list1 a{
	font-family: 'Montserrat', sans-serif;
    color: #03b5bf;
    font-size: 1.4vw;
    font-weight: 500;
}
h1 {
	font-size: 4vw;
	font-family: 'Montserrat', sans-serif;
	color: #ffffff;
	font-weight:600;
}
h2{
	font-family: 'Montserrat', sans-serif;
    color: #00fcff;
    font-size: 1.4vw;
    font-weight: 600;
}
input {
    border-right: none;
    border-left: none;
    border-top: none;
    border-bottom: 1px solid #03b5bf;
    font-size: 1.5vw;
    color: #00fcff;
    background-color: transparent;
	font-family: 'Montserrat', sans-serif;
	width: 100%;
    text-align: center;
}
input [type="text"]::-webkit-input-placeholder {color:#03b5bf;}
input [type="text"]::-moz-placeholder          {color:#03b5bf;}/* Firefox 19+ */
input [type="text"]:-moz-placeholder           {color:#03b5bf;}/* Firefox 18- */
input [type="text"]:-ms-input-placeholder      {color:#03b5bf;}

:focus::-webkit-input-placeholder {color: transparent}
:focus::-moz-placeholder {color: transparent}
:focus:-moz-placeholder {color: transparent}
:focus:-ms-input-placeholder {color: transparent}

input:focus{
	outline: none;
}
.button {
	background-color: #00c6ff;
    color: #485657;
    border: none;
    font-size: 1.3vw;
    height: 5%;
    width: auto;
    padding: 1vw 2vw;
    border-radius: 2vw;
    font-weight: 500;
    line-height: 0.5vw;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.6;
    min-width: 2vw;
    min-height: 2vw;
    font-weight: 600;
}
button:focus{
	outline: none;
}
iframe {
	border: 0;
    height: 25vw;
    width: 35vw;
}
#contactus_mobile, .hidden_h1{
	display: none;
}
.menu{display: none;}
@media screen and (max-width: 800px){
	.header{
		background-position: 70% 90%;
	}
	.top_wrap, #contactus{
		display:none;
	}
	.second_td{
		display: none;
	}
	.table_maps {
		width: 80%;
		margin-top: 0;
	}
	.maps_td iframe{
		height: 45vw;
	}
	.hidden_h1{
		display: flow-root;
		text-align: center;
	}
	.hidden_h1 h1{
		font-size: 10vw;
		margin-top: 10vw;
		margin-bottom: 3vw;
	}
	.header_mobile{
		display: block;
	}
	.header {
		height: auto;
		max-height: 100%;
	}
	.list1 th {
		width: 10%;
		padding: 2vw;
	}
	.list1 a {;
		font-size: 4vw;
	}
	.list1{
	margin-left: 20vw;
		margin-top: 5vw;
	}
	#contactus_mobile{
		display:block;
	}
	#contactus_mobile h2{
		font-size: 4vw;
		text-align: center;
		font-weight: 500;
	}
	input {
		text-align: center;
		font-size: 4.5vw;
	}
	.button {
		font-size: 5.3vw;
		height: 10vw;
		width: 55vw;
		border-radius: 5vw;
		font-weight: 500;
		margin-top: 5vw;
		margin-bottom: 15vw;
		font-weight:700;
	}
	iframe {
		width: 80vw;
	}
}
	</style>
	
    <body>
<?php include"assets/header.php" ?>
<?php include 'assets/menu_block.php'; ?>

<div id="fixed" class="content_container">
	<div class="header">
	
	<div class="hidden_h1"><h1><?php echo $texts[$lang]['h1']; ?></h1></div>
	
		<table class="table_maps">
		<tr>
			<td class="maps_td">
			
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2175.630375126022!2d24.070603980702685!3d56.95513378098559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfe3a3385cb9%3A0xea12a58c86969715!2s%C5%AAdens+iela+12%2C+Kurzemes+rajons%2C+R%C4%ABga%2C+LV-1007!5e0!3m2!1slv!2slv!4v1499758047897" width="100%" height="80vw" frameborder="0" style="border:0" allowfullscreen></iframe>
			
			</td>
			<td class="second_td" style="padding: 5vw;">
				<div id="contactus">
					<h1><?php echo $texts[$lang]['h1']; ?></h1>
					
				<table class="list1">
					<tr>
					<th><img src="img/location_icon.png" width="40%"></th>
					<td><a><?php echo $texts[$lang]['adress'] ?></a></td>
					</tr>
					<tr>
					<th><img src="img/mobile_icon.png" width="30%"></th>
					<td><a>+371 22334455</a><br></td>
					</tr>
					<tr>
					<th><img src="img/email_icon.png" width="40%"></th>
					<td><a>info@beepy.com</a><br></td>
					</tr>
				</table>

				<br><h2><?php echo $texts[$lang]['subscribe_h2']; ?></h2>
				<input type="text" name="e-mail" class="inputs_style" placeholder="<?php echo $texts[$lang]['placeholder']; ?>"/></br></br>
				<button class="button"><?php echo $texts[$lang]['subscribe']; ?></button>
				</div>
			</td>
		</tr>
		</table>

				<div id="contactus_mobile">
				<table class="list1">
					<tr>
					<th><img src="img/location_icon.png" width="90%"></th>
					<td><a><?php echo $texts[$lang]['adress'] ?></a></td>
					</tr>
					<tr>
					<th><img src="img/mobile_icon.png" width="55%"></th>
					<td><a>+371 22334455</a><br></td>
					</tr>
					<tr>
					<th><img src="img/email_icon.png" width="90%"></th>
					<td><a>info@beepy.com</a><br></td>
					</tr>
				</table>

				<h2><?php echo $texts[$lang]['subscribe_h2']; ?></h2>
				<div class="input" align="center"><input type="text" name="e-mail" class="inputs_style" placeholder="<?php echo $texts[$lang]['placeholder']; ?>"/></div>
				<div class="button_div" align="center"><button class="button"><?php echo $texts[$lang]['subscribe']; ?></button></div>
				</div>
	
	</div>
	
        <?php include 'assets/footer.php'; ?>  
</div>  
    </body>
</html>