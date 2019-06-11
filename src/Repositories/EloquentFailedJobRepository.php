<?php namespace MoldersMedia\FailedJobInterface\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use MoldersMedia\FailedJobInterface\Models\FailedJob;

class EloquentFailedJobRepository
{
    /**
     * @param Request $request
     * @return AbstractPaginator
     */
    public function getFailedJobs($request): AbstractPaginator
    {
        /** @var Builder $q */
        $query = (new FailedJob)
            ->when($request->input('tags', []), function (Builder $q) use ($request) {
                foreach ($request->input('tags') as $tag) {
                    $q = $q->orWhereRaw('json_contains(tags, \'["' . $tag . '"]\')');
                }

                return $q;
            })
            ->when($request->input('queues', []), function (Builder $q) use ($request) {
                return $q->whereIn('queue', $request->input('queues'));
            })
            ->when($request->filled('connection'), function (Builder $q) use ($request) {
                return $q->where('connection', $request->get('connection'));
            });

        $columns = [
            'id',
            'failed_at',
            'tags',
            'connection',
            'queue',            
        ];
        
        if (config('failed_job_interface.paginator_kind') === 'simple') {
            return $query->simplePaginate(null, $columns);
        } else {
            return $query->paginate(null, $columns);
        }
    }

    /**
     * @param $get
     * @return FailedJob
     */
    public function getJob($get): FailedJob
    {
        return (new FailedJob())->findOrFail($get);
    }

    /**
     * @return array
     */
    public function getConnectionsList(): array
    {
        return (new FailedJob())
            ->groupBy('connection')
            ->get(['connection'])
            ->pluck('connection', 'connection')
            ->toArray();
    }

    /**
     * @return array
     */
    public function getTagsList(): array
    {
        $data = (new FailedJob())
            ->distinct('tags')
            ->get(['tags'])
            ->pluck('tags');

        $tags = [];
        foreach ($data as $tagGroup) {
            foreach ((array)$tagGroup as $tag) {
                $tags[] = $tag;
            }
        }

        $tags = array_filter(array_unique($tags));

        return array_combine($tags, $tags);
    }

    /**
     * @return array
     */
    public function getQueuesList(): array
    {
        return (new FailedJob())
            ->groupBy('queue')
            ->get(['queue'])
            ->pluck('queue', 'queue')
            ->toArray();
    }
}