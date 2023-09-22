<?php
$tab1 =  array('a', 'b');
$tab2 = $tab1;
$tab2[0] = 'c';
echo $tab1[0];
echo $tab2[0];

function fun(&$tab)
{
    $tab[0] = 'x';
}

fun($tab1);

echo $tab1[0];
echo $tab2[0];

?>