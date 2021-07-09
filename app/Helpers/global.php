<?php
if(!function_exists('create_banner')){
    function create_banner($info, $style = 'success'){
        request()->session()->flash('flash.banner', $info);
        request()->session()->flash('flash.bannerStyle', $style);
    }
}
