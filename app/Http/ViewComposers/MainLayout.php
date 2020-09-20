<?php

namespace App\Http\ViewComposers;

use DB;
use Route;
 
use Illuminate\View\View;
use App\SiteSetting;
use Illuminate\Http\Request; 

class MainLayout
{
    private $text;

    public function __construct(Request $request)
    {
         
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $siteSetting = SiteSetting::first(); 
        // Meta information fetch
        $meta_description =  $logo = $meta_title = ''; 
        if($siteSetting->logo){
            $logo = $siteSetting->logo;
        }
        $view->with([
            'logo' => $logo,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
        ]);
    }
}