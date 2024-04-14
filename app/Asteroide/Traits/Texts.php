<?php

namespace App\Asteroide\Traits;

use Illuminate\Support\Str;

trait Texts
{
    public function encodeText($field)
    {
        return filled($this->{$field}) ? rawurlencode($this->{$field}) : null;
    }

    public function firstTranslation($field, $separator = '##')
    {
        return Str::contains($this->{$field}, $separator) ? explode($separator, $this->{$field})[0] : $this->{$field};
    }
}
