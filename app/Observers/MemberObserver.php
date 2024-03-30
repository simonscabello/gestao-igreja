<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function deleted(Member $member): void
    {
        $member->deleted_by = auth()->user()->id;
        $member->dismissed_date = now();

        $member->save();
    }
}
