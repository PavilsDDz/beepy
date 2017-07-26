<?php 
    $texts_footer = [];

    $texts_footer['lv'] = [];
    $texts_footer['en'] = [];
    $texts_footer['ru'] = [];

    $texts_footer['lv']['adress'] = 'Adresse:';
    $texts_footer['lv']['call'] = 'Zvaniet:';
    $texts_footer['lv']['email'] = 'Ē-pasts:';
    $texts_footer['lv']['adress_'] = 'Ūdens iela 12, Rīga, Latvija';
    $texts_footer['lv']['home'] = 'Sākums';
    $texts_footer['lv']['buy'] = 'Pirkt';
    $texts_footer['lv']['sell'] = 'Pārdot';
    $texts_footer['lv']['contacts'] = 'Kontakti';
    $texts_footer['lv']['account'] = 'Mans Profils';

    $texts_footer['en']['adress'] = 'Adress:';
    $texts_footer['en']['call'] = 'Call us:';
    $texts_footer['en']['email'] = 'E-mail:';
    $texts_footer['en']['adress_'] = 'Udens iela 12, Riga, Latvia';
    $texts_footer['en']['home'] = 'Home';
    $texts_footer['en']['buy'] = 'Buy';
    $texts_footer['en']['sell'] = 'Sell';
    $texts_footer['en']['contacts'] = 'Contacts';
    $texts_footer['en']['account'] = 'My Account';

    $texts_footer['ru']['adress'] = 'Адрес:';
    $texts_footer['ru']['call'] = 'Звоните:';
    $texts_footer['ru']['email'] = 'Эл. почта:';
    $texts_footer['ru']['adress_'] = 'Улица Уденс 12, Рига, Латвия';
    $texts_footer['ru']['home'] = 'Главная';
    $texts_footer['ru']['buy'] = 'Купить';
    $texts_footer['ru']['sell'] = 'Продать';
    $texts_footer['ru']['contacts'] = 'Контакты';
    $texts_footer['ru']['account'] = 'Мой Профиль';

 ?>
<div id="footer" align="center">

                <div class="tablefooter flex">
                        <div class="flex_div footerlogo" style="text-align:center"><img src="img/beepy_logo_w.svg"  width="60%"></div>
                        <div class="flex_div">
                        <!--
                            <table class="bottom_text_style">
                            <tr>
                                <td width="10%"><b><?php echo $texts_footer[$lang]['adress']; ?></b></td>
                                <td width="30%"><?php echo $texts_footer[$lang]['adress_']; ?></td>
                            </tr>
                            <tr>
                                <td><b><?php echo $texts_footer[$lang]['call']; ?></b></td>
                                <td>+371 25566778</td>
                            </tr>
                            <tr>
                                <td><b><?php echo $texts_footer[$lang]['email']; ?></b></td>
                                <td>info@beepy.lv</td>
                            </tr>
                            </table>-->

                            <ul>
                                <li><p><?php echo $texts_footer[$lang]['adress']; ?></p><?php echo $texts_footer[$lang]['adress_']; ?></li>
                                <li><p><?php echo $texts_footer[$lang]['call']; ?></p>+371 25566778</li>
                                <li><p><?php echo $texts_footer[$lang]['email']; ?></p>info@beepy.lv</li>
                            </ul>

                        </div>
                        <div class="flex_div">
               <!--         
                            <table class="table_links">
                            <tr>
                                <td width="20%"><a href="index.php"><?php echo $texts_footer[$lang]['home']; ?></a></td>
                            </tr>
                            <tr>
                                <td><a href="searching.php"><?php echo $texts_footer[$lang]['buy']; ?></a></td>
                                <td><a href="contacts.php"><?php echo $texts_footer[$lang]['contacts']; ?></a></td>
                            </tr>
                            <tr>
                                <td><a href="addcar.php"><?php echo $texts_footer[$lang]['sell']; ?></a></td>
                                <td><a href="profile.php"><?php echo $texts_footer[$lang]['account']; ?></a></td>
                            </tr>
                            </table>-->
                            <ul class="footer_nav">
                                <li><?php echo $texts_footer[$lang]['home']; ?></a></li>
                                <li><?php echo $texts_footer[$lang]['buy']; ?></a></li>
                                <li><?php echo $texts_footer[$lang]['sell']; ?></a></li>
                                <li><?php echo $texts_footer[$lang]['contacts']; ?></a></li>
                                <li><?php echo $texts_footer[$lang]['account']; ?></a></li>
                            </ul>
                        </div>

                        <div class="flex socials_wrap">
						<ul class="socials flex">
						<li><a><div class="soc_link fb"></div></a></li>
						<li><a><div class="soc_link inst"></div></a></li>
						<li><a><div class="soc_link tw"></div></a></li>
						</ul>
						</div>
                </div>
                        <p class="cp">copyrights 2017 beepy</p>

</div>  