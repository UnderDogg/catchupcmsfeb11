<?php

namespace App\Modules\Core\Http\Traits;

//use App\Modules\Core\Http\Scopes\TenantScope;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Config;
use Meta;
use Setting;


trait SeoTrait {


	/**
	 * Boot the tenantable trait for the model
	 *
	 * @return void
	 */
	public function setSeo($data)
	{
//dd('die');
// 		SEOMeta::setTitle($article->meta_title);
// 		SEOMeta::setDescription($article->meta_description);
// 		SEOMeta::setKeywords($article->meta_keywords);

//dd(isset($data));
		if ( isset($data) && !empty($data) ) {
			Meta::setTitle(Setting::get('title', Config::get('core.title')) . ', ' . $data->meta_title);
			Meta::setDescription(Setting::get('description', Config::get('core.description')) . ', ' . $data->meta_description);
			Meta::setKeywords(Setting::get('keywords', Config::get('core.keywords')) . ', ' . $data->meta_keywords);
		} else {
dd(Setting::get('title', Config::get('core.title')));
			Meta::setTitle(Setting::get('title', Config::get('core.title')));
			Meta::setDescription(Setting::get('description', Config::get('core.description')));
			Meta::setKeywords(Setting::get('keywords', Config::get('core.keywords')));
		}

	}


}
