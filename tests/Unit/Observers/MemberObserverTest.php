<?php

use App\Models\User;
use App\Models\Member;
use App\Observers\MemberObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('preenche dismissed_date e deleted_by automaticamente no deleting', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = Member::factory()->create();

    $member->delete();

    $deleted = Member::withTrashed()->find($member->id);

    expect($deleted->dismissed_date)->not->toBeNull()
        ->and($deleted->deleted_by)->toBe($user->id);
});
