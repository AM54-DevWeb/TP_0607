<?php

class Connexion extends PDO
{
    public function __construct()
    {
        parent::__construct(
            "mysql:dbname=cci_dwwm_2021_118_poo;host=localhost:3307",
            "root",
            ""
        );
    }
}
