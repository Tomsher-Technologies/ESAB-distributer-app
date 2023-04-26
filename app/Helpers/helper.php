<?php

function adminAsset($path)
{
    return asset('admin_asset/' . $path);
}

function isActiveRoute($route)
{
    return request()->routeIs($route) ? 'active' : '';
}