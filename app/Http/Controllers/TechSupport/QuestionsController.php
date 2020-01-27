<?php

namespace App\Http\Controllers\TechSupport;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupport\QuestionsRequest;
use App\Services\Repository\Interfaces\Repository;
use App\TechSupport\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /** @var Request */
    private $request;

    /** @var Repository */
    private $repository;

    public function __construct(QuestionsRequest $request, Repository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function index()
    {
        $settings = [
//            'filter' => [
//                'params' => $params
//            ],
            'columns' => [
                'id' => [
                    'title' => 'ID',
                ],
//                [
//                    'title' => 'ФИО',
//                    'field' => [
//                        'component' => 'text-field',
//                        'name' => 'name',
//                        'type' => 'text',
//                        'value' => $params['name'] ?? null
//                    ]
//                ],
                'subject' => [
                    'title' => 'Тема вопроса',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'subject',
                        'value' => $params['subject'] ?? null
                    ]
                ],
                'email' => [
                    'title' => 'E-mail',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'email',
                        'type' => 'email',
                        'value' => $params['email'] ?? null
                    ]
                ],
                'text' => [
                    'title' => 'Текст',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'text',
                        'type' => 'text',
                        'value' => $params['price'] ?? null
                    ]
                ],
                'status.title' => [
                    'title' => 'Статус',
                    'criteria' => [
                        'В ожидании' => 'label-danger',
                        'В работ' => 'label-warning',
                        'Закрыто' => 'label-success'
                    ],
                    'field' => [
                        'component' => 'data-filter-select',
                        'name' => 'status',
                        'elements' => [
                            '1' => 'В ожидании',
                            '2' => 'В работе',
                            '3' => 'Закрыто'
                        ],
                        'value' => $params['status'] ?? null
                    ]
                ]
            ],
            'actions' => [
                'delete' => [
                    'title' => 'Удалить'
                ]
            ]
        ];

        return view('admin.questions.index', ['settings' => json_encode($settings)]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $questions = $this->repository->all($this->request);
        return ['elements' => $questions, 'count' => $questions->count()];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if ($this->request->isMethod('GET')) {
            return view('admin.questions.create');
        }

        try {
            $this->repository->create($this->request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.questions.create');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        /** @var Question $question */
        $question = $this->repository->get($id);

        if ($this->request->isMethod('GET')) {
            return view('admin.questions.update', ['question' => $question]);
        }

        try {
            $this->repository->update($question, $this->request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.questions.create', ['question' => $question]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        /** @var Question $question */
        $question = $this->repository->get($id);

        try {
            $this->repository->delete($question);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.questions.index');
    }
}
