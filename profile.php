<?php 
$profile = 1;
include 'konfig.php';
if(empty($_SESSION['idnya']) & empty($_GET['id'])){
    die('TIDAK ADA FOTO :p');
} else {
        $query = mysql_query('SELECT * FROM avatar_ooiya WHERE id=\''.mysql_real_escape_string(addslashes($_GET['id'])).'\' LIMIT 1');
        if(mysql_num_rows($query)==1) {
                $data = mysql_fetch_assoc($query);
                if(!file_exists('temp/'.$data['id'].'_t.jpg')) {
                 die('ERROR!');
                } 
                  header('Content-Type: image/png');
                if(file_exists('temp/'.$data['id'].'_final.png') & empty($_POST['y'])) {
                     $dest = imagecreatefrompng('temp/'.$data['id'].'_final.png');
                     imagepng($dest);
                } else {
                    if($_POST['pilih']>0 & $_POST['pilih'] < 5) {
                        $dest = imagecreatefrompng($_POST['pilih'].'a.png');
                    } else {
                        $dest = imagecreatefrompng('1a.png');
                    }
                    $src = imagecreatefromjpeg('temp/'.$data['id'].'_t.jpg');

                    imagealphablending($dest, false);
                    imagesavealpha($dest, true);

                    imagecopymerge($dest, $src, 2, 1, $_POST['x'], $_POST['y'], 247, 496, 90);
                    
                    imagepng($dest, 'temp/'.$data['id'].'_final.png');
                    imagepng($dest);
                    imagedestroy($dest);
                    imagedestroy($src);
                }
            
        } else {
             die('TIDAK ADA FOTO :p');
        }
}
