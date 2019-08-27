<?php
    exec('mysqldump --user="btech2017" --password="btech2017" --quick btech2017 AS_ARG_TABLE > uploads/fname.sql');
    exec('tar -cvf BackUpDB.tar uploads');

    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"BackUpDB.tar\"");
    echo readfile('BackUpDB.tar');
?>
