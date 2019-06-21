<?php
class Config
{
     function pages($size)
    {
    $opt1 = intdiv($size,3)+1;
    $opt2 = $size / 3;
    $pages = (is_float($opt2))? $opt1 : $opt2;
    return $pages;
    }

    function refill($paginate, $books)
    {
    $index = (($paginate) + ($paginate - 3));

    $array = $books;
    $books = [];

    $books[0] = $array[$index + $paginate];
    if(isset($array[$index + $paginate + 1])){$books[1] = $array[$index + $paginate + 1];}
    if(isset($array[$index + $paginate + 2])){$books[2] = $array[$index + $paginate + 2];}

    return $books;
    }
}