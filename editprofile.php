<?php
    include ('assets/connect.php');
    include 'assets/setup.php';

    $texts = [];

	$texts['lv'] = [];
	$texts['en'] = [];
	$texts['ru'] = [];

	$texts['lv']['edit'] = 'Rediģēt';
	$texts['lv']['Choose_file'] = 'Izvēlēties Failu...';
	$texts['lv']['change_pic'] = 'Mainīt Bildi';
    $texts['lv']['fname'] = 'Vārds:';
	$texts['lv']['lname'] = 'Uzvārds:';
    $texts['lv']['uname'] = 'Lietotājs:';
	$texts['lv']['phone'] = 'Telefona numurs:';
    $texts['lv']['email'] = 'E-Pasts:';
	$texts['lv']['save'] = 'Saglabāt';
	$texts['lv']['cancel'] = 'Atcelt';

	$texts['en']['edit'] = 'Personal Info';
	$texts['en']['Choose_file'] = 'Choose File...';
	$texts['en']['change_pic'] = 'Change Picture';
    $texts['en']['fname'] = 'First Name:';
    $texts['lv']['lname'] = 'Uzvārds:';
	$texts['en']['uname'] = 'User Name:';
	$texts['en']['phone'] = 'Phone:';
    $texts['en']['email'] = 'E-Mail:';
	$texts['en']['save'] = 'Save';
	$texts['lv']['cancel'] = 'Cancel';
	
	$texts['ru']['edit'] = 'Редактировать';
	$texts['ru']['Choose_file'] = 'Выбрать Файл...';
	$texts['ru']['change_pic'] = 'Поменять изображение ';
    $texts['ru']['fname'] = 'Имя:';
    $texts['ru']['lname'] = 'Фамилия:';
	$texts['ru']['uname'] = 'Имя пользователя:';
	$texts['ru']['phone'] = 'Номер телефона:';
    $texts['ru']['email'] = 'Электронная почта:';
	$texts['ru']['save'] = 'Сохранить';
	$texts['ru']['cancel'] = 'Oтмена';


    if(isset($_SESSION['uid'])){
        $userQuery = "SELECT * FROM `users` WHERE id = :id ";
        $userPayload["id"] = $_SESSION['uid'];
        $userResult = getAllDataFromDatabase($userQuery, $userPayload);

        foreach($userResult as $userRow){

        }
    }

    $fileDestString ='';
    if(isset($_POST['btn-update'])){
        $payload["firstname"] = $_POST['firstname'];
        $payload["lastname"] = $_POST['lastname'];
        $payload["username"] = $_POST['username'];
        $payload["telephone"] = $_POST['telephone'];
        $payload["email"] = $_POST['email'];
        $payload["id"] = $_SESSION['uid'];

        $update = "UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, telephone = :telephone, email = :email WHERE id = :id";

        insertDataInToDataBase($update, $payload);

        foreach($userResult as $userRow){

        }
        

  
       if (isset($_FILES['file']['name'])&&count($_FILES['file']['name'])) {

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];

            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualyExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
                                    
                if ($fileTmpName != "") {
                    $fileNameNew = $_SESSION['uid'].'profileImg.'.$fileActualyExt;

                    $fileDestination = 'userimg/'.$fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                 //   echo "Uploaded";
                    $fileDestString = $fileDestString.$fileDestination;

                }
            }

            $sql = "UPDATE users SET image = :image WHERE id = :id";
            $imagePayload["image"] = $fileDestString;
            $imagePayload["id"] = $_SESSION['uid'];
        $row = insertDataInToDataBase($sql,  $imagePayload);
       }

        if(isset($userQuery)){
            header("location: profile.php");
        }

    }
    
?>

<!doctype html>
<html>
<head>
    <?php include"assets/head.php" ?>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/editprofile.css">
    <link rel="stylesheet" href="css/style.css">

</head>
    <body>
    <?php 
    include"assets/header.php"
    ?>

    <div align="center">
        <form method="post" enctype="multipart/form-data">
            <h1><?php echo $texts[$lang]['edit'] ?></h1>
            
            <table>
            <tr><td class="flex" style="justify-content: center;-webkit-justify-content: center;">
            <label class="file_upload">
                <span class="button"><?php echo $texts[$lang]['Choose_file'] ?></span>
                <input id="img_input" type="file" name="file">
            </label>
            </td></tr>
            
            </table>
            
            <br/><br/>
            
            <img id="img" src="<?php if($userRow['image']==''){echo "img/unset.png";}else{ echo $userRow['image'];} ?>" width="15%"><br><br>
            <script type="text/javascript">
                $(function(){
                      
                        
                    img = $('#img')
                    input = $('#img_input')
                    input.change(function(){
                        output = URL.createObjectURL(event.target.files[0]);
                        img.attr('src', output)

                    })

                })
            </script>
            
            <table class="table_inputs">
                <tr>
                    <td><label><?php echo $texts[$lang]['fname'] ?></label></td>
                    <td><input type="text" name="firstname" placeholder="firstname" value="<?php echo $userRow['firstname']; ?>"></td>
                </tr>
				<tr>
					<td><label><?php echo $texts[$lang]['lname'] ?></label></td>
					<td><input type="text" name="lastname" placeholder="lastname" value="<?php echo $userRow['lastname']; ?>"></td>
				</tr>
				<tr>
					<td><label><?php echo $texts[$lang]['uname'] ?></label></td>
					<td><input type="text" name="username" placeholder="username" value="<?php echo $userRow['username']; ?>"></td>
				</tr>
				<tr>
					<td><label><?php echo $texts[$lang]['phone'] ?></label></td>
					<td><input type="text" name="telephone" placeholder="telephone" value="<?php echo $userRow['telephone']; ?>"></td>
				</tr>
				<tr>
					<td><label><?php echo $texts[$lang]['email'] ?></label></td>
					<td><input type="text" name="email" placeholder="email" value="<?php echo $userRow['email']; ?>"></td>
				</tr>
			</table>
		<div class="buttons">
			<div class="submit_button" ><button type="submit" name="btn-update" id="btn-update" onClick="update()"><strong><?php echo $texts[$lang]['save'] ?></strong></button></div>	
            <div class="cancel"><a href="profile.php"><button type="button" value="button"><?php echo $texts[$lang]['cancel'] ?></button></a></div>
		</div>
        </form>
    <!-- Alert for Updating -->
        <script>
            function update(){
                var x;

               //if(confirm("Updated data Sucessfully") == true){
               //    x = "update";
               //}
            }
        </script>
	</div>
	<?php include'assets/footer.php' ?>
    </body>
</html>