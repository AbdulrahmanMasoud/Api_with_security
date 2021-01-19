<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use GeneralTrait;
    public function adminLogin(Request $request){
        try{
        //Validate
        /**
         * هنا انا هعمل فلديشن علي الايميل والباسورد
         * ف عملت متغير وقولتله اعمل فالديت علي الكل و استخدم متغير الرولز اللي اانا كتبته ده
         * وبعدين هقوله لو الفاديشن ده عمل fail
         * هقوله استخدم الاتنين ميثود اللي موجودين في فايل الtraits
         * 
         */
        $rules = [
            "email" => "required:admins,email",
            "password" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            /* الميثود دي بعد ما تاخد الايرو اللي جه ده منيين هل هو من  ايميل او باسورد او موبايل او اي حاجه من اللي متحدده ف ملف التريت
            * وتبحث ف ميثود تانيه موجوده اسمها getErrorCode()
            * عشان تجيب الكود اللي مشابه للحاجه اللي طلعت سواء بقا ايميل او باسورد او اي حاجه انا حاططها ف الاتشيك 
            */
            $code = $this->returnCodeAccordingToInput($validator);
            /**
             * دي بقا بتاخد الكود اللي جبته من الميثود اللي فوق عشان ترجعه في ال اي بي اي
             * و بتاخد اللي اتعمله فاليديت ده سواء ايميل او باسورد او اي حاجه
             * وتجيب الايرور بتعها من ميثود بتاعه لارفيل اللي اسمها errors()
             */
            return $this->returnValidationError($code, $validator);
        }
        //login
        // هنا بقوله حددلي بس الايميل والباسورد
        $credentials = $request -> only(['email','password']);
        /**
         * هنا انا هدخلي علي الاوث علي الجارد اللي موجود اللي انا عملته اللي اسمه admin-api
         * واستخدم فيه ال jwt
         * ويعمل جينيرات للتوكن
         */
        $token =  Auth::guard('admin-api')->attempt($credentials);
        /*هنا لو معملش جينيرات للتوكن يبقا هوملقاش الايميل ده في الداتا بيز ف هيرجع رساله الخطأ دي */
        if(!$token){return $this->returnError('E001','بيانات الدخول غير صحيحة');}
        
        //Return Data
        /**
         * هنا بقا بعد ما عمل التوكن  انا عايزه يجيب الداتا بتاعه اللي سجل دخول 
         * ف هجيبها عن طريق الجارد اللي انا عملته ف الاوث
         * وبالداله اللي اسمها user()
         * اللي موجوده ف ال jwt 
         * هجيب كل البيانات بتاعه اللي انا حددته ده
         * وبعدين اعملها ريتيرن بالميثود اللي موجوده ف فايل triat
         */
        $admin = Auth::guard('admin-api')->user();
        $admin->admin_token = $token;
        return $this->returnData('admin',$admin,'Login Done');

    }catch (\Exception $ex){
        /**
         * هنا بعد ما عملت كاتش 
         * هيجيبلي الايرور بتاعتي بالكود اللي طلع ف الايرور اللي انا محدده فيملف trait
         * ويجيب الايرور بقا من خلال ميثود بتاعه لارفيل اللي اسمها getMessage()
         * 
         */
        return $this->returnError($ex->getCode(), $ex->getMessage());
        //return Token
    }
    }
}
