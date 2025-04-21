<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function deleting(Member $member): void
    {
        $member->dismissed_date = now();
        $member->deleted_by = auth()->user()->id;

        $member->saveQuietly();
    }
}
