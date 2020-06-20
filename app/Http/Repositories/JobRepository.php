<?php


namespace App\Http\Repositories;


use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class JobRepository
 * @package App\Http\Repositories
 */
class JobRepository implements JobRepositoryInterface
{

    /**
     * @var Job
     */

    private $model;

    /**
     * PayRepository constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make(Job::class);
    }

    /**
     * @param int $id
     * @return Job|null
     *
     */
    public function findById(int $id): ?Job
    {
        return $this->model->find($id);
    }

    /**
     * @param string $title
     * @return Job|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function findByTitle(string  $title): ?Job
    {
        return  $this->model->where('title','=',$title)->first();

    }

    /**
     * @return Collection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function findAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param Job $job
     * @param array $data
     */
    public function save(Job $job, array $data)
    {
        if(!isset($data['show'])){
            $data['show'] = 0; //or whatever you want
        }
        else{
            $data['show'] = 1;
        }
        $job->title = $data['title'];
        $job->text = $data['text'];
        $job->show = $data['show'];
        $job->save();
    }

}
