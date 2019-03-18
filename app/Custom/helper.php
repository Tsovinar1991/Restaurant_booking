<?php

function compare_url($current_url, $data){
    foreach($data  as $key => $value){
        if($current_url == route('admin.page.single', $value->id)){
            return true;
        }
    }
}