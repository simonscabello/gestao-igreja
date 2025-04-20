<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Member;

class MemberObserver
{
    public function deleted(Member $member): void
    {
        $member->deleted_by = auth()->user()->id;
        $member->dismissed_date = Carbon::now()->format('Y-m-d');

        $member->save();
    }
}
