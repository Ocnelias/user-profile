<?php

namespace Core;


class Lang
{

    public static function currentLanguage(){

        return $_SESSION['lang'] ?? 'en';

    }


    public static function translate($string){

        $langpath = '../language/'.self::currentLanguage().'.php';


        if( ! is_file(  $langpath ) ) {
            return $string;

        } else {
            require_once ($langpath);
            return $translations[$string] ?? $string;


        }


    }


}