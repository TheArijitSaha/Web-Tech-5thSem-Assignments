<?php
try{
    $imagick = new Imagick();
    $imagick->readImage('ID_PDF_1.pdf');
    $imagick->writeImages('temp.jpg', false);

}
catch(\Exception $e)
{
    echo $e->getMessage();
}
?>
