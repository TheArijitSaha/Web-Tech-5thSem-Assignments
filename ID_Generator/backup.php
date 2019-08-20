<?php
    header( 'Location: http://cs.iiests.ac.in/~arijits/ID_Generator/BackUpDB.tar' );
    exec('mysqldump --user="btech2017" --password="btech2017" --quick btech2017 AS_ARG_TABLE > uploads/fname.sql');
    exec('tar -cvf BackUpDB.tar uploads');
?>
