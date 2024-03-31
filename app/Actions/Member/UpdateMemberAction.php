<?php

namespace App\Actions\Member;

use App\Models\Member;
use Illuminate\Support\Facades\DB;

class UpdateMemberAction
{
    public static function execute(array $data, Member $member): void
    {
        DB::transaction(function () use ($data, $member) {
            $member->update($data);
            if ($member->address) {
                $member->address->update($data);
                return;
            }
            $data['member_id'] = $member->id;
            $member->address()->create($data);
        });
    }
}
