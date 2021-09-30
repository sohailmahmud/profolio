<?php

namespace App\Http\Controllers;

use App\Http\Helpers\UserPermissionHelper;
use App\Jobs\SubscriptionExpiredMail;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    public function expired() {
        $exMembers = Membership::whereDate('expire_date', Carbon::now()->subDays(1))->get();
        foreach ($exMembers as $key => $exMember) {
            if (!empty($exMember->user)) {
                $user = $exMember->user;
                $currPackage = UserPermissionHelper::userPackage($user->id);

                if (is_null($currPackage)) {
                    SubscriptionExpiredMail::dispatch($user);
                }
            }
        }

        \Artisan::call("queue:work", ["--stop-when-empty"]);
    }
}
