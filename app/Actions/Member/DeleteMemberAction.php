<?php

namespace App\Actions\Member;

use App\Models\Member;

class DeleteMemberAction
{
    public static function execute(Member $member): void
    {
        $member->delete();
    }
}
