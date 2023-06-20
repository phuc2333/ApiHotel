<?php

namespace App\Http\Middleware;

use App\Models\Groups;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkActionPermissionGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
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
         $group = Groups::select('permission')->where('id', $request->id)->get();
        if($group){
            $user = Auth::user();
            $roleJson = $user->group->permission;
       
            $roleArr = json_decode($roleJson, true);

            if (isRole($roleArr, $module,'permission')) {
                // Nếu có, tiếp tục thực hiện các middleware tiếp theo trong chuỗi middleware
                return $next($request);
                return response()->json([
                    'message' => 'Bạn có quyền truy cập vào module '
                ], 403);
            } else {
                // Nếu không, trả về một HTTP response với mã lỗi 403 (Forbidden)
                return response()->json([
                    'message' => 'You do not have permission to access this permission in group'
                ], 403);
            }
            return $next($request);
        }
        return response()->json([
            'message' => 'Bạn không có quyền truy cập vào permission '
        ], 403);
    }
}
