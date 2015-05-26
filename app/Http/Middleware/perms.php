<?php namespace App\Http\Middleware;

use App\Library\RequestParser;
use Closure;
use Illuminate\Support\Facades\DB;

class Perms {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $route = app()->router->getRoutes()->match($request);

        if(is_string($route->getAction()['uses'])) {
            if(auth()->check() && isset(auth()->user()->id)){
                $RP = new RequestParser($request, $route);
                if($RP->getControllerName()!="auth\\authcontroller") {
                    $sql = '
                        SELECT ug.user_id FROM user_group as ug
                          JOIN group_perms AS gp ON
                            (
                                gp.group_id=ug.group_id AND
                                (gp.controller=? OR gp.controller IS NULL) AND
                                (gp.controller IS NULL OR (gp.action=? OR gp.action IS NULL) )
                            )
                            JOIN groups AS g ON g.id=ug.group_id AND g.status>0
                        WHERE ug.user_id=' . (int)auth()->user()->id;

                    $perm = DB::select($sql,[$RP->getControllerName(),$RP->getControllerMethod()]);
                    if (count($perm) < 1) return response()->view('errors.custom',['content'=>"Bu sayfaya yetkiniz bulunmuyor!"]);
                    //$controllerName = $RP->getControllerName();
                    //$methodName     = $RP->getControllerMethod();
                }
            }
        }else return response()->view('errors.custom',['content'=>"Bu sayfaya yetkiniz bulunmuyor!"]);

		return $next($request);
	}

}
