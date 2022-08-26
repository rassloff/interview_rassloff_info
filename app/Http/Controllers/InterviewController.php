<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\InterviewQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InterviewController extends Controller
{
    public function addQuestion( $interview_id )
    {
        Log::debug('in add interview_id='.$interview_id);
        return view('interviews.addQuestion' )->with('interview_id', $interview_id);
    }

    public function storeQuestion(Request $request, $interview_id)
    {
        //Log::debug('in store interview_id='.$interview_id);
        //Log::debug('in store question = ' . $request->question );

        $request['interview_id'] = $interview_id;

        $request->validate([
            'question' => 'required',
        ]);

        $interviewQuestion = InterviewQuestion::create($request->all());

        $interviewQuestion->createdBy()->associate(Auth::user());
        $interviewQuestion->updatedBy()->associate(Auth::user());
        $interviewQuestion->update();

        return redirect()->route('interviews.show', $interview_id)->with('success', 'Interview Question saved correctly!!!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $interviews = Interview::latest()->paginate(5);

        return view('interviews.index',
            compact('interviews'))
            ->with('i', (request()
                        ->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('interviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $interview = Interview::create($request->all());

        $interview->createdBy()->associate(Auth::user());
        $interview->update();

        return redirect()->route('interviews.index')
            ->with('success','Interview created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Interview $interview): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('interviews.show', compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Interview $interview)
    {
        return view('interviews.edit',compact('interview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $interview->update($request->all());

        $interview->updatedBy()->associate(Auth::user());
        $interview->update();


        return redirect()->route('interviews.index')
            ->with('success','Interview updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Interview $interview)
    {
        $interview->delete();

        return redirect()->route('interviews.index')
            ->with('success','Interview deleted successfully');
    }
}
