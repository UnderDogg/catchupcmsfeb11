<?php

//namespace App\Modules\Shisan\Http\Widgets;
//namespace App\Widgets\Shisan;
namespace App\Widgets;

use Caffeinated\Widgets\Widget;

use App\Modules\Newsdesk\Http\Models\News;

// use App;
use Cache;
// use Config;
// use Menu;
// use Session;
// use Theme;
use Schema;

class AllNews extends Widget
{


	public function handle()
	{
		$count = $this->coountAllNews();
		return $count;
	}


	public function coountAllNews()
	{

		$count = trans('kotoba::general.error.no_data');

		if (Cache::has('newsdesk_count_all_contents')) {
			$count = Cache::get('newsdesk_count_all_contents');
//dd($count);
		} else {
//dd('die');
			$count = count($this->getAllNews());
			Cache::forever('newsdesk_count_all_contents', $count);
		}

		return $count;

	}


	public function getAllNews()
	{

		if (Cache::has('newsdesk_all_contents')) {
			$all_contents = Cache::get('newsdesk_all_contents');
		} else {
			$all_contents = Cache::rememberForever('newsdesk_all_contents', function() {
				return New::all();
			});
		}

		return $all_contents;

	}


}