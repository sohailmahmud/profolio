<?php

namespace App\Http\Middleware;

use App\Http\Helpers\UserPermissionHelper;
use App\Models\User;
use App\Models\User\UserPermission;
use Closure;
use Illuminate\Http\Request;

class RouteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $page)
    {
        $user = User::where('username', $request->username)->firstOrFail();
        $currentPackage = UserPermissionHelper::userPackage($user->id);
        $preferences = UserPermission::where([
            ['user_id',$user->id],
            ['package_id',$currentPackage->package_id]
        ])->first();
        $userPermissions = isset($preferences) ? json_decode($preferences->permissions, true) : [];
        $packagePermissions = UserPermissionHelper::packagePermission($user->id);
        $packagePermissions = json_decode($packagePermissions, true);

        if (!in_array($page,$userPermissions) || !in_array($page,$packagePermissions)) {
            return redirect()->route('front.user.detail.view', $request->username);
        }

        return $next($request);
    }
}
