<?php

function htmlClear($string)
{
    $result = trim(strip_tags(str_replace('<', ' <', $string)));
    return preg_replace('/\s{2,}/', ' ', $result);
}

?>