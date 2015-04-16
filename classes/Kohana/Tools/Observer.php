<?php defined('SYSPATH') or die('No direct script access.');

interface Kohana_Tools_Observer
{
    function observed(Kohana_Tools_Observed $o);
}
