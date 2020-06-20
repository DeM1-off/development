<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobReuest;
use App\Http\Service\Job\JobServiseInterface;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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
     * HomeController constructor.
     * @param JobServiseInterface $jobService
     */
    public function __construct(JobServiseInterface $jobService)
    {
        $this->middleware('auth');



        $this->jobService = $jobService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $jobs = $this->jobService->getOnlyOneUser();

        return view('job.home', compact('jobs'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * @param JobReuest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(JobReuest  $request)
    {


        $user = auth()->user()->id;

        $job = new Job();

        $job->title =$request->get('title');
        $job->text =$request->get('text');
        $job->user_id =  $user;
        $job->show =  $request->has('show');;


        $job->save();


        return redirect(route('home.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $job = $this->fetchPayOrFail($id);
        return view('job.show', compact('job'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
      $job =  $this->fetchPayOrFail($id);

      return view('job.edit', compact('job'));

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

        return redirect(route('home.index'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $jobs = Job::findOrFail($id);

        $jobs->delete();
        return redirect(route('home.index'));
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

