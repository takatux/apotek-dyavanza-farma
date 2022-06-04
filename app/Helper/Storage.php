<?php

namespace App\Helper;

class Storage
{
    public static function uploadImageKlub($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = "Obat_". date('Y-m-d H:i:s') . "." . $ext;
      $fileImage->move(base_path("public/assets/img/obat"), $name);

      return $name;
    }
}
