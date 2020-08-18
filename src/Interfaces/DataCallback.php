<?php

namespace codicastudio\LaravelMixpanel\Interfaces;

interface DataCallback
{
    public function process(array $data = []) : array;
}
