<?php


namespace App\Http\Service\Job;


use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

interface JobServiseInterface
{
    /**
     * @param int $id
     * @throws \Exception
     * @return Job
     */
    public function getJobById( int $id): Job;

    /**
     * @throws \Exception
     * @return Job
     */
    public function getOnlyOneUser();
    /**
     * @throws \Exception
     * @param int|null $page
     * @return Collection
     */
    public function getAllPosts(int $page = null): Collection;

    /**
     * @throws \Exception
     * @param array $jobData
     * @return int
     */
    public function createPay(array $jobData): int;


    /**
     * @throws \Exception
     * @param int $id
     * @param array $payData
     * @return int
     */
    public function updateJob(int $id, array $payData);

    /**
     * @throws \Exception
     * @param int $id
     */
    public function deleteJob(int $id): void;
}
