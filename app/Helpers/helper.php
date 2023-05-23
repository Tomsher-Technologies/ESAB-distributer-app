<?php

function adminAsset($path)
{
    return asset('admin_asset/' . $path);
}

function isActiveRoute($route)
{
    return request()->routeIs($route) ? 'active' : '';
}

function getInitials($str, $limit = 0)
{
    preg_match_all('/(?<=\b)\w/iu', $str, $matches);
    $result = mb_strtoupper(implode('', $matches[0]));
    if ($limit > 0) {
        $result = substr($result, 0, $limit);
    }
    return $result;
}


function optionSelected($array, $val = 'all')
{
    if ($array !== null) {
        return in_array($val, $array) ? 'selected' : '';
    } elseif ($val == 'all') {
        return 'selected';
    }
    // ( in_array('all', $old_request->country) || empty($old_request->country) ) ? 'selected' : ''
}
