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

    $texts_footer['ru']['adress'] = '';
    $texts_footer['ru']['call'] = '';
    $texts_footer['ru']['email'] = '';
    $texts_footer['ru']['adress_'] = '';
    $texts_footer['ru']['home'] = '';
    $texts_footer['ru']['buy'] = '';
    $texts_footer['ru']['sell'] = '';
    $texts_footer['ru']['contacts'] = '';
    $texts_footer['ru']['account'] = '';

 ?>
<div id="footer">

            <div align="center">
                <table class="tablefooter">
                    <tr>
                        <td width="25%" style="text-align:center"><img src="img/logo3.png" width="60%"></td>
                        <td width="30%">
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
                            </table>
                        </td>
                        
                        <td width="35%">
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
                            </table>
                        </td>
                        <td width="10%" style="text-align:right padding-right:1vw"><img src="img/google.png" width="70%"></td>
                    </tr>
                </table>
            </div>

        </div>  