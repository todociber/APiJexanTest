<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 19/04/2017
 * Time: 11:25 PM
 */
class Token_generator
{

    public function __construct()
    {


    }

    public function tokens_generator()
    {

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

        $longitudCadena = strlen($cadena);


        $pass = "";

        $longitudPass = 100;


        for ($i = 1; $i <= $longitudPass; $i++)
        {

            $pos = rand(0, $longitudCadena - 1);


            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }
}