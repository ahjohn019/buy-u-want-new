<?php

function currencyList($currency) {
    switch ($currency) {
        case 'Malaysia':
            return 'myr';
            break;
        case 'Singapore':
            return 'sgd';
            break;
        default:
            return 'myr';
            break;
    }
}

function states(){
    //
}