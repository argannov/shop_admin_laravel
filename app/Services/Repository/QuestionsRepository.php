<?php

namespace App\Services\Repository;

use App\Services\Repository\Interfaces\Repository;
use App\TechSupport\Question;
use Illuminate\Http\Request;

class QuestionsRepository implements Repository
{

    /**
     * @inheritdoc
     */
    public function get($slug)
    {
        return Question::find($slug);
    }

    /**
     * @inheritdoc
     */
    public function all(Request $request = null)
    {
        return Question::all();
    }

    /**
     * @inheritdoc
     */
    public function create(Request $request): bool
    {
        $question = Question::create($request->post());
        return $question->save();
    }

    /**
     * @inheritdoc
     */
    public function update($model, Request $request): bool
    {
        return $model->update($request->post());
    }

    /**
     * @inheritdoc
     */
    public function delete($model): bool
    {
        return (bool)$model->delete();
    }
}
