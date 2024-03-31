<?php

namespace App\Actions\Member;

use App\Models\Member;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class StoreMemberAction
{
    public static function execute(array $data): Member
    {
        return DB::transaction(function () use ($data) {
            $member = Member::create($data);
            $data['member_id'] = $member->id;
            Address::create($data);
            return $member;
        });
    }
}
