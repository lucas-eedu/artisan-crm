<?php

namespace App\Helpers;

class ProfileHelper
{
   public static function isSuperAdministrator()
   {
      return auth()->user()->profile_id == 1 ? true : false;
   }

   public static function isAdministrator()
   {
      return auth()->user()->profile_id == 2 ? true : false;
   }

   public static function isSeller()
   {
      return auth()->user()->profile_id == 3 ? true : false;
   }
}