<?php

function htmlClear($string)
{
    $result = trim(strip_tags(str_replace('<', ' <', $string)));
    return preg_replace('/\s{2,}/', ' ', $result);
}

function user_name_limit($string, $limit = -1)
{
	if ($limit < 0) {
		return $string;
	}
	$words = preg_split('/\s+/', trim($string));
	if (sizeof($words) < 2) {
		return str_limit($words[0], $limit);
	}

	$nameMustTruncate = collect([
		'muhammad' => 'M.',
		'mohammad' => 'M.',
		'muhamad' => 'M.',
		'mohamad' => 'M.',
		'mr.' => '',
		'mr' => '',
		'miss' => '',
		'mrs.' => '',
		'mrs' => '',
		'dr' => '',
		'dr.' => '',
		'prof' => '',
		'prof.' => '',
		'professor' => '',
		'ir' => '',
		'ir.' => '',
	]);
	$firstName = $words[0];
	if ($nameMustTruncate->has(strtolower($firstName))) {
		$firstName = $nameMustTruncate->get(strtolower($firstName));
	}
	$result = $firstName;
	$counter = 1;
	while ($counter < sizeof($words)) {
		if (strlen($result) + strlen($words[$counter]) > $limit) {
			break;
		}
		$result .= ' '.$words[$counter];
		$counter++;
	}
	return $result;
}
?>