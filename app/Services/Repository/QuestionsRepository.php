<?php

namespace App\Services\Repository;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\Interfaces\Repository;
use App\TechSupport\Question;
use Illuminate\Http\Request;

class QuestionsRepository implements Repository
{

    /**
     * @var FiltrationKeeper
     */
    private $filtrationKeeper;

    public function __construct(FiltrationKeeper $filtrationKeeper)
    {
        $this->filtrationKeeper = $filtrationKeeper;
    }

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
        $builder = Question::with('status');

        if ($subject = $request->get('subject')) {
            $builder->where('subject', 'like', '%'.$subject.'%');
        }

        if ($email = $request->get('email')) {
            $builder->where('email', $email);
        }

        if ($text = $request->get('text')) {
            $builder->where('text', 'like', '%'.$text.'%');
        }

        if ($status = $request->get('status')) {
            $builder->whereHas('status', function ($query) use ($status) {
                $query->where('id', $status);
            });
        }

        $this->filtrationKeeper->saveParams(Question::class, $request->all());

        return $builder->get();
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
