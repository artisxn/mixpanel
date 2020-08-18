<?php

namespace codicastudio\LaravelMixpanel\Tests\Fixtures\App;

use codicastudio\LaravelMixpanel\Interfaces\DataCallback;

class MixpanelUserData implements DataCallback
{
    public function process(array $data = []) : array
    {
        $data["test"] = "value";

        return $data;
    }
}
