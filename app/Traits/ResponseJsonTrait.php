<?php

namespace App\Traits;


trait ResponseJsonTrait
{
    public function generic($content = '', int $code)
    {

        return response($content, $code);
    }

    public function success($content = '')
    {
        return $this->generic($content, 200);
    }

    public function fail($content = '')
    {
        return $this->generic($content, 400);
    }
}
