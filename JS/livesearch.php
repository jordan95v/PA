<?php

$xml = simplexml_load_file("./film.xml");
$content = $xml->film;

$param = $_GET["q"];
$hint = "";

for ($i = 0; $i < count($content); $i++) {
    if (strchr($content[$i], trim($param))) {
        if ($hint == "") {
            $hint = '<a href="" class="mb-3 text-decoration-none text-white">' . ucwords($content[$i]) . '</a>';
        } else {
            $hint .= '</br><a href="" class="text-decoration-none text-white">' . ucwords($content[$i]) . '</a>';
        }
    }
}

if ($hint == "") {
    echo "No suggestion";
} else {
    echo $hint;
}
