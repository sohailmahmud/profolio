<?php

namespace App\Http\Helpers;

use App\Models\Membership;
use App\Models\Package;
use Carbon\Carbon;
use Exception;

class UserPermissionHelper{

    public static function packagePermission(int $userId){
        $currentPackage = Membership::query()->where([
            ['user_id', '=', $userId],
            ['status','=',1],
            ['start_date','<=', Carbon::now()->format('Y-m-d')],
            ['expire_date', '>=', Carbon::now()->format('Y-m-d')]
        ])->first();
        $package = isset($currentPackage) ? Package::query()->findOrFail($currentPackage->package_id): null;
        return $package? $package->features : collect([]);
    }

    public static function uniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    public static function currentPackagePermission(int $userId){
        $currentPackage = Membership::query()->where([
            ['user_id', '=', $userId],
            ['status','=',1],
            ['start_date','<=', Carbon::now()->format('Y-m-d')],
            ['expire_date', '>=', Carbon::now()->format('Y-m-d')]
        ])->first();
        return isset($currentPackage) ? Package::query()->findOrFail($currentPackage->package_id):null;
    }
    public static function userPackage(int $userId){
        return Membership::query()->where([
            ['user_id', '=', $userId],
            ['status','=',1],
            ['start_date','<=', Carbon::now()->format('Y-m-d')],
            ['expire_date', '>=', Carbon::now()->format('Y-m-d')]
        ])->first();
    }

}
