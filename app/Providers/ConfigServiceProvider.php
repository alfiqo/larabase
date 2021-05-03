<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->makeAbsoluteUrls();
    }

    /**
     * Make relative urls into absolute urls
     *
     * @return void
     */
    public function makeAbsoluteUrls()
    {
        // dd(config('adminlte'));
        foreach (Config::get('adminlte') as $key => $config) {
            if ($key === 'menu') {
                foreach ($config as $keyconf => $value) {
                    if (isset($value['submenu'])) {
                        foreach ($value['submenu'] as $sub => $submenu) {
                            if (strpos(\Request::getRequestUri(), $submenu['url']) !== false) {
                                Config::set("adminlte.menu.$keyconf.submenu.$sub.active", [\Request::getRequestUri()]);
                            }
                        }
                    }
                }
            }
        }
    }
}
