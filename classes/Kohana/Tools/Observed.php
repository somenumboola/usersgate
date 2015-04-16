<?php

interface Kohana_Tools_Observed
{
    function attach(Kohana_Tools_Observer $ob);
    function detach(Kohana_Tools_Observer $ob);
    function notify($method, array $arguments = array());
}
