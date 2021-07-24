<?php
if (!function_exists('create_banner')) {
    function create_banner($info, $style = 'success')
    {
        request()->session()->flash('flash.banner', $info);
        request()->session()->flash('flash.bannerStyle', $style);
    }
}

if (!function_exists('check_vehicle')) {
    function check_vehicle($id)
    {
        $today = date("Y-m-d");
        $veh = \App\Models\Vehicle::findOrFail($id);
        return $veh->insurance <= $today || $veh->tax <= $today|| $veh->mot <= $today || $veh->service < $veh->mileage;

    }
}
