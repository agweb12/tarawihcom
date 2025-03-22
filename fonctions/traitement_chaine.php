<?php

function supprAccents($string){
	return strtr($string,'àáâãäçèéëêìíîïñòóôöõùúûüýÿÀÁÂÃÄÇÈÉËÊÌÍÎÏÑÒÓÔÖÕÙÚÛÜÝŸ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYY');
}

function supprSpeciaux($string){
	$string = strtr($string,"' @\"\\/#,()*","-----------");
	$string = str_replace("--","-",$string);
	return $string;
}

?>