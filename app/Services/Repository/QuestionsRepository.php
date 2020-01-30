<?php

namespace App\Services\Repository;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\TechSupport\Question;
use Illuminate\Http\Request;

class QuestionsRepository extends BaseRepository
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

        $this->filtrationKeeper->saveParams(Question::class, $request);

        return $this->paginate($builder, $request->get('currentPage', 1));
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
