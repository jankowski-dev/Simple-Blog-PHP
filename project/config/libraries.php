<?php

function sortDateAsc($a, $b)
{
    return (strtotime($a['date']) - strtotime($b['date']));
};

function sortDateDesc($a, $b)
{
    return (strtotime($b['date']) - strtotime($a['date']));
};
