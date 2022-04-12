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
        <form method="POST" action="./Result">
      
        <h1 style="font-style: normal;">Dump It!</h1>
            
            <input id="input" type="hidden" value="<?=$_GET['code']?>" name="code" required>
            <input id="input" type="hidden" value="<?=$refreshToken?>" name="refresh" required>
            <select id="input" name="motherlink" required>
                <option  selected>⬇ Select the main playlist</option>
                <?php foreach($playlists as $id=>$playlist):?>
                    <option value="<?=$id?>"><?=$playlist?></option>
                <?php endforeach?>
            </select>
           
            <input id="input" type="number" min="2" max="1000" name="number" placeholder="Number of Tracks to Dump" required/>
         
            <select id="input" name="childlink" required>
                <option selected>⬇ Select the dump playlist</option>
                <?php foreach($playlists as $id=>$playlist):?>
                    <option value="<?=$id?>"><?=$playlist?></option>
                <?php endforeach?>
            </select>
    
        
            <div style="display: flex; align-items:center">
            <label for="checkbox">Empty playlist?</label>
            <input type="checkbox" name="emptyPlaylist" id="checkbox" />
            </div>
     
            <input id="input" type="submit" value="Go"/>
  
        </form>
    </main>
</body>
</html>