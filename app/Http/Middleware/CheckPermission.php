<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tempNameRoute = $request->route()->getName();
        $array = explode('.', $tempNameRoute);
        foreach ($array as $key => $value) {
            if ($key == 1) {
                $module = $value;
            }
        }

        // Sử dụng Auth middleware để xác thực người dùng
       // $user = Auth::user();
       $user = Auth::user();
      
        // Lấy thông tin về vai trò của người dùng
        $roleJson = $user->group->permission;
       
        $roleArr = json_decode($roleJson, true);
       
        // Kiểm tra vai trò của người dùng có chứa quyền truy cập vào module cần kiểm tra không
        if (isRole($roleArr, $module)) {
            // Nếu có, tiếp tục thực hiện các middleware tiếp theo trong chuỗi middleware
            //return $next($request);
            return response()->json([
                'message' => 'Bạn có quyền truy cập vào module '
            ], 403);
        } else {
            // Nếu không, trả về một HTTP response với mã lỗi 403 (Forbidden)
            return response()->json([
                'message' => 'You do not have permission to access this module'
            ], 403);
        }
    }
}