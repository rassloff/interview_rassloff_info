<?php

namespace App\Http\Controllers;

use App\Models\InterviewAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $interviewAnswers = InterviewAnswer::latest()->paginate(5);

        return view('interviewAnswers.index',
            compact('interviewAnswers'))
            ->with('i', (request()
                        ->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('interviewAnswers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required',
        ]);

        $interview = InterviewAnswer::create($request->all());

        $interview->createdBy()->associate(Auth::user());
        $interview->update();

        return redirect()->route('interviewAnswers.index')
            ->with('success','Interview created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterviewAnswer  $interviewAnswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(InterviewAnswer $interviewAnswer)
    {
        return view('interviewAnswers.show', compact('interviewAnswer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterviewAnswer  $interviewAnswer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(InterviewAnswer $interviewAnswer)
    {
        return view('interviewAnswers.edit',compact('interviewAnswer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InterviewAnswer  $interviewAnswer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, InterviewAnswer $interviewAnswer)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $interviewAnswer->update($request->all());

        $interviewAnswer->updatedBy()->associate(Auth::user());
        $interviewAnswer->update();


        return redirect()->route('interviewAnswers.index')
            ->with('success','Interview updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterviewAnswer  $interviewAnswer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(InterviewAnswer $interviewAnswer)
    {
        $interviewAnswer->delete();

        return redirect()->route('interviewAnswers.index')
            ->with('success','Interview deleted successfully');
    }
}
