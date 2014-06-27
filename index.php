<?php
include 'konfig.php';
?>
<!doctype html>
<html>
<head>

	<title>AVATAR OOIYA by Kolby</title>
        <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
         <script src="js/jquery.min.js"></script>
        <script src="js/jquery.Jcrop.js"></script>
       
        <script src="js/jquery.color.js"></script>
</head>
<body>
    <div style="width:900px; margin-left: auto; margin-right: auto; font-family: arial;">
        <h3>AVATAR OOIYA by <a href="https://www.ooiya.com/22862" target="_blank">KolbyArt</a></h3>
    <?php
    if($_GET['foto']==1) {
        include 'gambar.php';
        if(!empty($_FILES['foto']['tmp_name'])) {
            
            if(empty($_SESSION['idnya'])) {
                $q      = mysql_query('INSERT INTO avatar_ooiya (tgl,ip) VALUES (NOW(),\''.$_SERVER['REMOTE_ADDR'].'\')');
                $sql = '';
                
            } else {
                
                $sql = 'WHERE id=\''.$_SESSION['idnya'].'\'';
            }
            $q2     = mysql_query('SELECT id FROM avatar_ooiya '.$sql.' ORDER BY id DESC LIMIT 1');
            $data   = mysql_fetch_assoc($q2);
            $_SESSION['idnya'] = $data['id'];
            
            $gambar = new ResizeImage($_FILES['foto']['tmp_name']);
            $gambar->resizeTo(500, 500,'maxheight');
            $gambar->saveImage('temp/'.$_SESSION['idnya'].'_t.jpg');
            
        ?>
    <script>
    $(function(){ $('#foto').Jcrop({ 
                //aspectRatio: 2/4,
                minSize: [247,496],
                maxSize: [247,496],
                onSelect : updateCoords
                }); 
            });
            function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};
                        function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('di Crop atau pilih dulu baru klik simpan.');
				return false;
			};
    </script>
    <form action="<?php echo $data['id'];?>.png?id=<?php echo $data['id']; echo '&'.  rand(99, 999);?>" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
        <input type="hidden" name="id" value="<?php echo $data['id'];?>">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>Crop Foto kamu : <br/>
        <img src="temp/<?php echo $_SESSION['idnya'].'_t.jpg';?>" id="foto"><br/></td>
            </tr>
            <tr>
                <td>
                    Pilih Template :<br/>
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td><img src="1a.png" width="250"></td>
                            <td><img src="2a.png" width="250"></td>
                            <td><img src="3a.png" width="250"></td>
                            <td><img src="4a.png" width="250"></td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="pilih" value="1"> Cover 1</td>
                            <td><input type="radio" name="pilih" value="2"> Cover 2</td>
                            <td><input type="radio" name="pilih" value="3"> Cover 3</td>
                            <td><input type="radio" name="pilih" value="4"> Cover 4</td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
        
        
        <input type="submit" value="Ok Buat Avatar!" style="padding: 6px;"> &bull; <a href="index.php">Kembali</a>
    </form>
    
    <?php
        } else {
            echo 'ERROR! :p';
        }
    } else {
        ?>
    
    <form action="index.php?foto=1" method="post" enctype="multipart/form-data">
        Pilih terlebih dahulu foto kamu : 
        <input type="file" name="foto"><br/>
        <input type="submit" value="upload!">
    </form>
    <?php
    $_SESSION['idnya'] = '';
    $_SESSION['filenya'] = '';
    }
    ?>
    
    <br/>
    Jangan lupa gabung di : <a href="http://www.ooiya.com">Ooiya.com</a>
        </div>
    
</body>
</html>
