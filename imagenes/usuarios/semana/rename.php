<?php
 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 }

/*
$renombro = rename("logos/105/2014-05-05_11-53-46_logo%20ipn%20ciidir.jpg", "logos/105/2014-05-05_11-53-46_logo ipn ciidir.jpg");
if ($renombro)
	echo "renombro archivo";
else
	echo "no encontro archivo";
*/

//rrmdir("logos");
//rrmdir("materiales");
