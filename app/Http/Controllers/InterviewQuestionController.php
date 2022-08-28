<?php

namespace App\Http\Controllers;

use App\Models\InterviewQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InterviewQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $questions = InterviewQuestion::latest()->paginate(5);

        return view('interviewQuestions.index',
            compact('questions'))
            ->with('i', (request()
                        ->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, $interview_id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        Log::debug('id=' . $interview_id);

        $interview_id = $request->interview_id;
        if(isset($interview_id)){
            //echo "bla ballala . $interview_id";
            Log::debug('id=' . $interview_id);
        }
        else{
            Log::debug('no id=' . $interview_id);
        }
        return view('interviewQuestions.create', compact('interview_id'));
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
            'question' => 'required',
        ]);

        $question = InterviewQuestion::create($request->all());

        $question->createdBy()->associate(Auth::user());
        $question->updatedBy()->associate(Auth::user());
        $question->update();

        return redirect()->route('interviewQuestions.index')
            ->with('success','Interview Question created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterviewQuestion  $interviewQuestion
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(InterviewQuestion $interviewQuestion)
    {
        return view('interviewQuestions.show', compact('interviewQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterviewQuestion  $interviewQuestion
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(InterviewQuestion $interviewQuestion)
    {
        return view('interviewQuestions.edit',compact('interviewQuestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InterviewQuestion  $interviewQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, InterviewQuestion $interviewQuestion)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $interviewQuestion->update($request->all());

        $interviewQuestion->updatedBy()->associate(Auth::user());
        $interviewQuestion->update();


        return redirect()->route('interviewQuestions.index')
            ->with('success','Interview Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterviewQuestion  $interviewQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(InterviewQuestion $interviewQuestion)
    {
        $interviewQuestion->delete();

        return redirect()->route('interviewQuestions.index')
            ->with('success','Interview deleted successfully');
    }
}
