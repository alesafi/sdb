<?php

$renombro = rename("logos/105/2014-05-05_11-53-46_logo%20ipn%20ciidir.jpg", "logos/105/2014-05-05_11-53-46_logo ipn ciidir.jpg");
if ($renombro)
	echo "renombro archivo";
else
	echo "no encontro archivo";
