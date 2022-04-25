<?php

namespace App\Enums;

enum StudentSex: string
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    public static function names(): array
    {
      return array_column(self::cases(), 'name');
    }
  
    public static function values(): array
    {
      return array_column(self::cases(), 'value');
    }
  
    public static function array(): array
    {
        return array_chunk(array_combine(self::values(), self::names()), 1, true);
    }
}