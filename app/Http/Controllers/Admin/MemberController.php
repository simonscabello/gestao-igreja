<?php

namespace App\Http\Controllers\Admin;

use App\Enum\MemberGenderEnum;
use App\Enum\MemberMaritalStatusEnum;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        return view('members.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = MemberGenderEnum::cases();
        $maritalStatuses = MemberMaritalStatusEnum::cases();

        return view('members.create', [
            'genders' => $genders,
            'maritalStatuses' => $maritalStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Member::create($request->all());
        return to_route('member.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
