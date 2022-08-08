<?php


function load()
{
    $numArgs = func_num_args();
    $argsList = func_get_args();
    $url = func_get_arg(0);

    $value = 'load(\''.$url.'\'';

    for ($i = 1; $i < $numArgs; $i++)
        $value .= ', \''.$argsList[$i].'\'';

    $value .= ');';

    return $value;
}

/* End of file */