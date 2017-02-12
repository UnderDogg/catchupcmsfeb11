<?php

namespace App\Modules\Menus\Http\Middleware;

use Closure;
use CMenu;
use Caffeinated\Menus\Builder;

use App\Modules\Himawari\Http\Models\Content as Content;

use Cache;


class MenuMiddleware
{


	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure                  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		CMenu::make('navLinks', function(Builder $menu) {
//			$activeTheme = Theme::getActive();
//Cache::forget('menu_navlinks');

			$pages = Cache::get('menu_navlinks', null);
//dd(count($pages));
// /dd(Cache::get('menu_navlinks'));

			if ($pages == null) {
//dd('menu_navlinks');
				$pages = Cache::rememberForever('menu_navlinks', function() {
					$timed_pages = Content::InPrint()->SiteID()->IsNavigation()->IsTimed()->orderBy('order')->get();
					$normal_pages = Content::InPrint()->SiteID()->IsNavigation()->NotTimed()->orderBy('order')->get();
					return $timed_pages->merge($normal_pages);
				});
			}
//dd($pages);

			foreach ($pages as $page)
			{
				$menu->add($page->title, ['url' => $page->slug, 'class' => 'nav-link']);
			}
			});

		return $next($request);
	}


}
