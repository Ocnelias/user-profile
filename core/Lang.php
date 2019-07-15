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
            require ($langpath);

            return array_key_exists($string,$translations) ? $translations[$string] : $string;

        }


    }


}