<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Enum\MemberGenderEnum;
use App\Http\Controllers\Controller;
use App\Enum\MemberMaritalStatusEnum;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return view('members.index', ['members' => $members]);
    }

    public function create()
    {
        $genders = MemberGenderEnum::cases();
        $maritalStatuses = MemberMaritalStatusEnum::cases();

        return view('members.create', [
            'genders' => $genders,
            'maritalStatuses' => $maritalStatuses,
        ]);
    }

    public function store(StoreMemberRequest $request)
    {
        Member::create($request->validated());

        toast('Membro cadastrado com sucesso!','success');

        return to_route('member.index');
    }

    public function show(Member $member)
    {
        return view('members.show', ['member' => $member]);
    }

    public function edit(Member $member)
    {
        $genders = MemberGenderEnum::cases();
        $maritalStatuses = MemberMaritalStatusEnum::cases();

        return view('members.edit', [
            'member' => $member,
            'genders' => $genders,
            'maritalStatuses' => $maritalStatuses,
        ]);
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    public function destroy(Member $member)
    {
        $member->delete();

        toast('Membro deletado com sucesso!','success');

        return to_route('member.index');
    }
}
