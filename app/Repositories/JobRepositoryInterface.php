<?php


namespace App\Repositories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface JobRepositoryInterface
 * @package App\Repositories
 */
interface JobRepositoryInterface
{
    /**
     * @param int $id
     * @return Job|null
     */
    public function findById(int $id): ?Job;

    /**
     * @param string $title
     * @return Job|null
     */
    public function findByTitle(string $title): ?Job;

    /**
     * @return Collection
     */
    public function findAll() :Collection;

    /**
     * @param Job $job
     * @param array $data
     * @return mixed
     */
    public function save(Job $job, array $data);
}
