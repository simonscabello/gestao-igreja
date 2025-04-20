<?php

use App\Models\User;
use App\Models\Member;
use App\Observers\MemberObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('seta dismissed_date e deleted_by no observer', function () {
    $user = User::factory()->create();
    $this->be($user);

    $member = Member::factory()->create();

    // Aciona diretamente o observer
    $observer = new MemberObserver();
    $observer->deleted($member);

    expect($member->dismissed_date)->not->toBeNull()
        ->and($member->deleted_by)->toBe($user->id);
});
