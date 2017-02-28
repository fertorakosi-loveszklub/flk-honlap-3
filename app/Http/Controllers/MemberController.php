<?php

namespace App\Http\Controllers;

use App\MemberProfile;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['admin_module' => 'member']);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = MemberProfile::orderBy('card_id', 'desc')->get();

        return view('admin.members', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member-form', ['member' => new MemberProfile()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules());

        MemberProfile::create($request->all(9));

        return redirect()->route('members.index')->with('status', [
            'type' => 'success',
            'message' => 'Tag sikeresen felvéve'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = MemberProfile::findOrFail($id);

        return view('admin.member-form', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules($id));

        $member = MemberProfile::findOrFail($id);
        $member->fill($request->all());
        $member->save();

        return redirect('/admin/members')->with('status', [
            'type' => 'success',
            'message' => 'Tag adatai sikeresen frissítve'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MemberProfile::destroy($id);

        return redirect('/admin/members')->with('status', [
            'type' => 'success',
            'message' => 'Tag sikeresen törölve'
        ]);
    }

    protected function getValidationRules($id = null)
    {
        $exception = $id ? ",$id" : '';
        return [
            'name' => 'required',
            'born_at' => 'required|date',
            'birth_place' => 'required',
            'mother_name' => 'required',
            'address' => 'required',
            'joined_at' => 'required|date',
            'card_id' => "required|integer|unique:member_profiles,card_id$exception"
        ];
    }
}
