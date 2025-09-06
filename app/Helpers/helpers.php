<?php

use Illuminate\Support\Facades\Session;
function admin_lang(){
    return Session::get('admin_lang');
}
function font_lang(){
    return Session::get('font_lang');
}

?>
