<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/b0c45caebd.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('layout/navbar.php')?>

    <main style="height: 70vh; justify-content: center;">
        <form method="POST" action="./Result.php">
            
            <input type="hidden" value="<?=$_GET['code']?>" name="code" required>
            <input type="hidden" value="<?=$refreshToken?>" name="refresh" required>
            <select name="motherlink" required>
                <option selected>⬇ Select the main playlist</option>
                <?php foreach($playlists as $id=>$playlist):?>
                    <option value="<?=$id?>"><?=$playlist?></option>
                <?php endforeach?>
            </select>
            <br/>
            <input type="text" name="number" required/>
            <br/>
            <select name="childlink" required>
                <option selected>⬇ Select the dump playlist</option>
                <?php foreach($playlists as $id=>$playlist):?>
                    <option value="<?=$id?>"><?=$playlist?></option>
                <?php endforeach?>
            </select>
            <br/>
            <input type="submit"/>
        </form>
    </main>
</body>
</html>