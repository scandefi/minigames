<?php

class Helpers
{
  public static function botDetected()
  {
    $bot = false;
    if(!isset($_SERVER['HTTP_USER_AGENT'])) $bot = true;
    if(preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) $bot = true;
    if(config('app.env') === 'production' && request()->ip() === '127.0.0.1') $bot = true;
    // if(config('app.env') === 'production' && request()->ip() !== '127.0.0.1') $bot = true;
    return $bot;
  }
  
  public static function previousRouteName()
  {
    return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
  }

  public static function previousRouteParameters()
  {
    return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->parameters;
  }

  public static function previousRequest()
  {
    return app('request')->create(url()->previous());
  }

  public static function previousRoute()
  {
    return app('router')->getRoutes()->match(self::previousRequest());
  }
}
