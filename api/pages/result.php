<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>dumpi-fy</title>
    <script src="https://kit.fontawesome.com/b0c45caebd.js" crossorigin="anonymous"></script>
    <link rel="icon" href="./img/logo.png">
</head>
<body>
    <?php include('layout/navbar.php') ?>

    <main>
        <?php if(isset($erro)){
           echo '<h1 style="text-align: center; border: 0px solid red; width: 100%;">' . $erro . '</h1>';?>
           <h3 onclick="location.href='./Create'"
            style="text-align: end; border: 0px solid red; width: 100%; cursor: pointer">Click Here to Dump Again*</h3>
        <?php 
        }else{
        ?>
            <h1 style="text-align: center; border: 0px solid red; width: 100%;">Songs dumped!</h1>
            <h2 
            onclick="window.open('https://open.spotify.com/playlist/<?=$childlink?>', '_blank').focus()"
            style="text-align: start; border: 0px solid red; width: 100%; cursor: pointer">*Click Here to Open It</h2>
            <h3 onclick="location.href='./Create'"
            style="text-align: end; border: 0px solid red; width: 100%; cursor: pointer">Click Here to Dump Again*</h3>
        <?php } ?>
    </main>

    <?php include('layout/footer.php') ?>
</body>
</html>