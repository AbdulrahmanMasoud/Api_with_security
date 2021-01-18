<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * هنا اول حاجه انا عملت ميدل وير عشان احدد اجيب الداتا من الداتابيز باللغه العربيه او الانجليزيه
         * ازاي بقا اعمل كده اول حاجه خليت اللغه الاساسيه عربي عن طريق الميثود setLocale
         * تاني حاجه قولتله لو الريكوست اللي اسمه لانج ده موجود و الريكوست اللي اسمه لانج اللغه بتاعته تساوي انجليزي 
         * ف انت هتحولي اللغه بتاعه الابلكيشن ل انجليزي 
         * لكن لو مش انجليزي ف هي كده كده انا محددها عربي 
         * اخر نقطه بقا انا هجيب الداتا من الكنترولر علي هذا الاساس
         */
        app()->setLocale('ar');
        if (isset($request->lang) && $request->lang == app()->setLocale('en')) {
            app()->setLocale('en');
        }
        return $next($request);
    }
}
