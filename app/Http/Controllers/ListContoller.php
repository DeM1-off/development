<?php


namespace App\Http\Controllers;

use App\Http\Requests\JobReuest;
use App\Http\Service\Job\JobServiseInterface;
use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;



/**
 * Class ListContoller
 * @package App\Http\Controllers
 */
class ListContoller  extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * @var JobServiseInterface
     */
    private $jobService;

    /**
     * ListContoller constructor.
     * @param JobServiseInterface $jobService
     */
    public function __construct(JobServiseInterface $jobService)
    {

        $this->jobService = $jobService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user()->id;
        $role = Role::where('role_id', '=', $user)->count();
        $jobs = Job::all();

        return view('list.index', compact('jobs','role'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $job = $this->fetchPayOrFail($id);
        return view('list.show', compact('job'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $job =  $this->fetchPayOrFail($id);

        return view('list.edit', compact('job'));

    }

    /**
     * @param JobReuest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update(JobReuest $request, $id)
    {

        $this->jobService->updateJob($id, $request->all());

        return redirect(route('list.index'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $jobs = Job::findOrFail($id);
        $jobs->delete();

        return redirect(route('list.index'));
    }

    /**
     * @param int $id
     * @return Job
     */
    private function fetchPayOrFail(int $id)
    {
        try {
            return $this->jobService->getJobById($id);

        }
        catch (\Exception $e){
            abort(Response::HTTP_NOT_FOUND,$e->getMessage());
        }

    }


}
