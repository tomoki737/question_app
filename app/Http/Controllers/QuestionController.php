<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest as QuestionRequest;
use App\Question;
class QuestionController extends Controller
{
    public function __constract(){
        $this->authorizeResource(Question::class, 'question');
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all());
        $question->user_id = $request->user()->id;
        $question->save();
        return redirect(route('home'));
    }


    public function edit(Question $question)
    {
        return view('questions.edit', ['question' => $question]);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all())->save();
        return redirect(route('home'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect(route('home'));
    }

    public function show(Question $question)
    {
        $answers = $question->answer->sortByDesc('created_at');
        return view('questions.show', ['question' => $question, 'answers' => $answers]);
    }

    public function like(Request $request, Question $question)
    {
        $question->likes()->detach($request->user()->id);
        $question->likes()->attach($request->user()->id);
        return [
            'id' => $question->id,
            'countLikes' => $question->count_likes,
        ];
    }

    public function unlike( Request $request, Question $question)
    {
        $question->likes()->detach($request->user()->id);
        return [
            'id' => $question->id,
            'countLikes' => $question->count_likes,
        ];
    }
}