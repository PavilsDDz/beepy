<html>
<header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
		
<script>
	window.onload= function() {
	document.getElementById('toggler').onclick = function() {
		openbox('box', this);
		return false;
	};
};
	function openbox(id, toggler) {
		var div = document.getElementById(id);
		if(div.style.display == 'block') {
			div.style.display = 'none';
		}
		else {
			div.style.display = 'block';
		}
}
</script>
<style>
li, ul{
	list-style:none;
}
@media screen and (max-width: 800px){
	.signup {
    background-color: transparent;
    border-radius: 0;
    height: 0;
}
.menu {
    display: flex;
    position: absolute;
    z-index: 2;
    /* left: 85vw; */
    right: 10px;
    top: 30px;
}
#box{
    position: absolute;
    width: 45vw;
    height: 68vw;
    z-index: 2;
    background-color: #167894;
    opacity: 0.7;
    right: 0;
    top: 75px;
}
.links_box {
    position: relative;
    text-align: center;
    top: 10vw;
	padding: 0;
}
.list_home a{
	font-family: 'Montserrat', sans-serif;
    color: white;
    font-size: 4vw;
    font-weight: 600;
    text-align: left;
    text-transform: capitalize;
}
.languages{
	display: flex;
    padding: 0vw;
    margin-left: 0;
}
.languages li{
	flex-flow: wrap;
    margin: 0.5vw 6px 0 3vw;
}
.wrapp {
    display: flex;
    padding-left: 10vw;
    padding-top: 10vw;
}
.text{
	padding: 2vw;
    text-align: center;
}
.text a{
	text-transform: uppercase;
	color: white;
	font-weight: 600;
	font-family: 'Montserrat', sans-serif;
	font-size: 3.2vw;
}
}
</style>
</header>
<body>
	<div class="menu"><a id="toggler" href="#"><img src="img/menu.png" width="65px"></a></div>
	<div id="box" style="display: none;">
		<div class="list_home">
			<ul class="links_box">
				<li><a href="searching.php"><?php echo $texts_haeder[$lang]['buy'] ?></a></li>
				<li><a href="addcar.php"><?php echo $texts_haeder[$lang]['sell'] ?></a></li>
				<li><a href="contacts.php"><?php echo $texts_haeder[$lang]['contacts'] ?></a></li>
				<li><a>_______</a></li>
				<li><a class="signup" href="signup.php"><?php echo $texts_haeder[$lang]['signup'] ?></a></li>
				<li><a href="login.php"><?php echo $texts_haeder[$lang]['login'] ?></a></li>
			</ul>
			
			<div class="wrapp">
				<div class="color column">
					<div class="text">
						<a>EN</a>
					</div>
				</div>
				<div class="color column">
					<div class="text">
						<a>LV</a>
					</div>
				</div>
				<div class="color column">
					<div class="text">
						<a>RU</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>

</body>
</html>