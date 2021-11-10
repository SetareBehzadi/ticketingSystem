<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Discount\Coupon\CouponValidator;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    private $coupon;
    private $validator;


    public function __construct(Coupon $coupon,CouponValidator $validator)
    {
        $this->middleware('auth');   
        $this->coupon = $coupon; 
        $this->validator = $validator;
    }

    public function store(Request $request){

      //  dd($request->all());
       try{

             $request->validate([
                'coupon' => ['required', 'exists:coupons,code']
            ]);
        
            //user can it ? 

            $coupon = Coupon::where('code' ,$request->coupon)->firstOrFail();
            $this->validator->isValid($coupon);



            session()->put(['coupon'=>$coupon]);

            return redirect()->back()->withSuccess('کد تخفیف با موفقیت اعمال شد.');

        }catch(\Exception $e){
            return redirect()->back()->withError('کد تخفیف نا معتبر میباشد.');
        }
      
        

    }

    public function remove(){
        session()->forget('coupon');
        return back();
    }
}
