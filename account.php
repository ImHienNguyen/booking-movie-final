<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Mlem Cinema</title>
</head>
    <!-- <link rel="icon" href="logo.png" type="image/gif" sizes="16x16"> -->
<body>
    <?php
    
    $link = mysqli_connect("localhost", "root", "", "cinema_db");
    $sql = "SELECT * FROM account where username='$user'";
    $result = mysqli_fetch_assoc(mysqli_query($link, $sql));
    // print_r($result);

    $username = $result['username'];
    $firstname = $result['firstname'];
    $lastname = $result['lastname'];
    $email = $result['email'];
    $sdt = $result['sdt'];



    // [username] => mvmanh
    // [firstname] => Mai
    // [lastname] => Văn Mạnh
    // [email] => mvmanh@gmail.com
    // [sdt] => 123456789

    ?>
    <header></header>
    <section class="account-info-container">
        <h1>Hello <?=$firstname?> <?=$lastname?></h1>
        <h3>Your account info</h3>
        <div class="account-container">
            <table>
            <tr>
                <td>Username</td>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $firstname.' '. $lastname; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?php echo $sdt; ?></td>
            </tr>
        </table>
        <a href="forgot.php">Change your password</a> 
        </div>
    </section>

    <footer></footer>

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>
</html>