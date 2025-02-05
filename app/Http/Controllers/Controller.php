<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\SeoRepository;

class Controller extends BaseController
{
    public function seo($langId = 1){
    	$seoRepository = new SeoRepository();
		$seo = $seoRepository->getOne($langId)->toArray();

		$viewData['seo'] 		= $seo;
		$viewData['seo']['host_url'] = 'http://'.$_SERVER['HTTP_HOST'];
		$viewData['pageTitle'] 	= 'SEO 範例';
		$viewData['landApi'] 	= 1;

        return $viewData;
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}



