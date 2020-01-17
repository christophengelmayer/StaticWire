<?php
namespace ProcessWire;
include("index.php");

function iteratePages($page, $callback)
{
    if (is_callable($callback)) {
        call_user_func($callback, $page);
    }
    foreach ($page->children as $child) {
        iteratePages($child, $callback);
    }
}

iteratePages($pages->get("/"), function ($page) {
    $path = './static' . $page->url;
    mkdir($path, 0700, true);
    file_put_contents($path."index.html", $page->render());
    echo $page->url . "\n";
});