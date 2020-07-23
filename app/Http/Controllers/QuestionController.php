<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        $request->user()->questions()->create(
            [
                'title' => $request->title,
                'body' => $request->body,
            ]
        );

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //increment question views count by 1
        $question->increment('views');
        return view('questions.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access Denied");
        }
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionStoreRequest $request, Question $question)
    {
        //authorize using policy
        $this->authorize('update', $question);
        $question->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect(route('questions.index'))->with('success', "Your question has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //authorize using gate
//        if (Gate::denies('delete-question', $question)) {
//            abort(403, "Access Denied");
//        }
        $this->authorize('delete', $question);
        $question->delete();
        return redirect(route('questions.index'))->with('success', "Your question has been deleted");
    }
}
