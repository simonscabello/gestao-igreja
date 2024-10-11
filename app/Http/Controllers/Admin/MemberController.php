<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\View\View;
use App\Enum\MemberGenderEnum;
use App\Http\Controllers\Controller;
use App\Enum\MemberMaritalStatusEnum;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    public function index(): View
    {
        $members = Member::orderBy('name')->get();

        return view('members.index', ['members' => $members]);
    }

    public function create(): View
    {
        $genders = MemberGenderEnum::cases();
        $maritalStatuses = MemberMaritalStatusEnum::cases();

        return view('members.create', [
            'genders' => $genders,
            'maritalStatuses' => $maritalStatuses,
        ]);
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        $member = Member::create($request->validated());

        $member->address()->create($request->validated());

        toast('Membro cadastrado com sucesso!','success');

        return to_route('member.show', $member);
    }

    public function show(Member $member): View
    {
        return view('members.show', ['member' => $member]);
    }

    public function edit(Member $member): View
    {
        $member->load('address');

        $genders = MemberGenderEnum::cases();
        $maritalStatuses = MemberMaritalStatusEnum::cases();

        return view('members.edit', [
            'member' => $member,
            'genders' => $genders,
            'maritalStatuses' => $maritalStatuses,
        ]);
    }

    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        $member->update($request->validated());

        if (!$member->address) {
            $member->address()->create($request->validated());
        }

        if ($member->address) {
            $member->address->update($request->validated());
        }

        toast('Membro atualizado com sucesso!', 'success');

        return to_route('member.show', $member);
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        toast('Membro deletado com sucesso!','success');

        return to_route('member.index');
    }
}
