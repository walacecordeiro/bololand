<?php

function valideAdmin(){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!empty($_SESSION["admin"])) {
        return true;
    } 
    return false
}

function valideUser(){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!empty($_SESSION["user"])) {
        return true;
    } 
    return false
}