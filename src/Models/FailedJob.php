<?php namespace MoldersMedia\FailedJobInterface\Models;

use Illuminate\Database\Eloquent\{
    Model,
    Builder
};

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

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('failed_at', 'desc');
        });
    }    
}
