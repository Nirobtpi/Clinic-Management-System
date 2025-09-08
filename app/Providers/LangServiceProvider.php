<?php

namespace App\Providers;

use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class LangServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->extend(('translator'),function($translator,$app){

            // laravel default file loader
            $loader=new FileLoader(new Filesystem(),base_path('lang'));

            // current locale set in config/app.php
            $locale=$app['config']['app.locale'];

            // $fallback set in config/app.php
            $fallback=$app['config']['app.fallback_locale'];

            // return new Translator($loader,$locale);
            $customTrans=new class($loader,$locale) extends Translator{
                public function get($key, array $replace=[],$locale= null, $fallback=true){

                   $line=parent::get("messages.$key",$replace,$locale,false);

                   if($line !== "messages.$key"){
                    return $line;
                   }
                   return parent::get($key,$replace,$locale,$fallback);

                }
            };
            
            $customTrans->setFallback($fallback);
            return $customTrans;

        });
    }

    public function boot() {}
}
