<?php
    header( 'Location: http://cs.iiests.ac.in/~arijits/ID_Generator/members.php' );
    exec('rm -f -r uploads');
    exec('tar -xvf '.$_FILES['RestoreFile']['tmp_name'].' uploads');
    exec('mysql --user="btech2017" --password="btech2017" btech2017 < uploads/fname.sql');
    exec('chmod -R 757 uploads');
?>
