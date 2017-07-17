<?php
        include ('connect.php');
        session_start();

        $user_check = $_SESSION['login_user'];
        $_SESSION['test'] = 'aasasadadf';
        $username = $_POST['username'];
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username=:username");
        $stmt->execute(array(':username'=>$username));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $login_session = $row['username'];
   
        if(!isset($_SESSION['login_user'])){
            header("location:welcome.php");
            die();
        }
?>