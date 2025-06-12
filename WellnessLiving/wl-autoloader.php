<?php

/**
 * Autoloader class for the WellnessLiving SDK.
 */
class WlSdkAutoloader
{
  /**
   * Registers the autoloader function with PHP.
   */
  public static function register()
  {
    spl_autoload_register(function ($s_class) {
      $s_class_path = __DIR__ . '/' . str_replace('\\', '/', $s_class) . '.php';

      if (file_exists($s_class_path)) {
        require_once $s_class_path;
      }
    });
  }
}
