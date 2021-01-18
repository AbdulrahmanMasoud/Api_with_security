<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiCheckPassword
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
        /*
        * هنا انا عملت الميدل وير ده عشان يعمل باسورد لل اي بي اي كله عشان مش اي حد يستخدمه
        * اول حاجه ضيفت المديل وير ده في الكيرنك عشان اشغله 
        * تاني حاجه قولتله لو الريكوست اللي اسمه اي بي اي باسورد ده لا يساوي الثابت اللي موجود في صفحه الانف اللي هو اي بي اي باسورد
        * هيرجلي رساله ان الباسورد غلط ولو صح هيكمل عادي
        * اخر حاجهاستخدمت المديل وير ده علي الجروب
        *
        */
        if($request->api_password !== env('API_PASSWORD')){
            return response()->json(['message'=>'API Password Is Wrong :(']);
        }
        return $next($request);
    }
}
