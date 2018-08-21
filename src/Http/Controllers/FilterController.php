<?php namespace MoldersMedia\FailedJobInterface\Http\Controllers;

use Illuminate\Routing\Controller;
use MoldersMedia\FailedJobInterface\Repositories\EloquentFailedJobRepository;

class FilterController extends Controller
{
    /**
     * @var EloquentFailedJobRepository
     */
    private $repository;

    /**
     * FilterController constructor.
     * @param EloquentFailedJobRepository $repository
     */
    public function __construct(EloquentFailedJobRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConnections()
    {
        $data = $this->repository->getConnectionsList();

        return response()->json([
            'filters' => $data
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTags()
    {
        $data = $this->repository->getTagsList();

        return response()->json([
            'filters' => $data
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQueues()
    {
        $data = $this->repository->getQueuesList();

        return response()->json([
            'filters' => $data
        ]);
    }
}