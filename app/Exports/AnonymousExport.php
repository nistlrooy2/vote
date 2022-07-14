<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;


class AnonymousExport implements FromArray
{
    
    protected $anonymous;

    public function __construct(array $anonymous)
    {
        $this->anonymous = $anonymous;
    }

    public function array(): array
    {
        return $this->anonymous;
    }
}
