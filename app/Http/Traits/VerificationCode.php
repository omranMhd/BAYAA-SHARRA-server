<?php

namespace App\Http\Traits;


use Nette\Utils\Random;

trait VerificationCode
{
    public function generateCode()
    {
        return Random::generate(4, "0-9");
    }
}
