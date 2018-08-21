<?php namespace MoldersMedia\FailedJobInterface\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs';
    protected $casts = [
        'tags' => 'array'
    ];

    public function __construct(array $attributes = [])
    {
        $this->setPerPage(config('failed_job_interface.per_page'));

        parent::__construct($attributes);
    }
}