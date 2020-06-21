<?php


namespace App\Service\Job;

use App\Repositories\JobRepositoryInterface;
use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class JobServise
 * @package App\Http\Service\Job
 */
class JobServise implements JobServiseInterface
{
    /**
     * @var JobRepositoryInterface
     */

    private $jobRRepository;

    /**
     * PayService constructor.

     * @param JobRepositoryInterface $jobRRepository
     */
    public function __construct(JobRepositoryInterface $jobRRepository)
    {
        $this->jobRRepository = $jobRRepository;
    }

    /**
     * @param int $id
     * @return Job
     */
    public function getOnlyOneUser( )
    {
        $user = auth()->user()->id;
        $job = Job::where('user_id','=',$user)->get();
        return   $job;

    }


    /**
     * @param int $id
     * @return Job
     * @throws \Exception
     */

    public function getJobById(int $id): Job
    {
        $job = $this->jobRRepository->findById($id);
        if(!$job) {
            throw new \Exception('Pay not found');
        }
        return   $job;
    }

    /**
     * @param int|null $page
     * @return Collection
     */

    public function getAllPosts(int $page = null): Collection
    {
        return $this->jobRRepository->findAll();
    }

    /**
     * @param array $payData
     * @return int
     */

    public function createPay(array $payData): int
    {
        $existedPay = $this->jobRRepository->findByTitle($payData['spending']);
        if ($existedPay) {
            throw new \Exception('Post already exists with spending');
        }
    }

    /**
     * @param int $id
     * @param array $payData
     * @return int
     */

    public function updateJob(int $id, array $payData): int
    {
        $jobs = $this->jobRRepository->findById($id);
        $this->jobRRepository->save($jobs, $payData);
        return $jobs->id;
    }

    /**
     * @param int $id
     */
    public function deleteJob(int $id): void
    {
        // TODO: Implement deletePost() method.
    }


}
