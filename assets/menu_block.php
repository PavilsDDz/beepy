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
.menu{
    display: block;
    position: absolute;
	z-index: 2;
    top: 3vw;
	left: 85vw;
    right: 5vw;
}
#box{
    position: absolute;
    width: 45vw;
    height: 68vw;
    z-index: 2;
    background-color: #02bdcf;
    opacity: 0.7;
    right: 0;
    margin-top: 10vw;
}
.links_box{
	left: 4vw;
    position: relative;
}
.separate{
	left: 3vw;
    position: relative;
}
.list_home{
	position: relative;
    top: 6vw;
    left: 8vw;
    width: 15vw;
}
.list_home a{
	font-family: 'Montserrat', sans-serif;
    color: white;
    font-size: 4vw;
    font-weight: 600;
    text-align: left;
    text-transform: capitalize;
}
span{
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
}
</style>
</header>
<body>
	<div class="menu"><a id="toggler" href="#"><img src="img/menu.png" width="100%"></a></div>
	<div id="box" style="display: none;">
		<div class="list_home">
			<ul class="links_box">
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			</ul>
			<div class="separate"><span>___________</span></div>
			<ul class="languages">
				<li>LV</a></li>
				<li>EN</a></li>
			</ul>
		</div>
	</div>

</body>
</html>