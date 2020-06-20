<?php


namespace App\Console\Commands;


use App\Http\Service\Role\RoleServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RoleDelete
 * @package App\Console\Commands
 */
class RoleDelete extends Command
{
    /**
     * @var string
     */
    protected $signature = 'role:delete ';


    /**
     * @var string
     */
    protected $description = 'Delete admin';

    /**
     * @var  RoleServiceInterface $roleservice
     */
    private  $roleservice;

    /**
     * RoleDelete constructor.
     * @param RoleServiceInterface $roleservice
     */
    public function __construct(RoleServiceInterface $roleservice)
    {
        $this->roleservice = $roleservice;
        parent::__construct();

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $roleList = $this->roleservice->getUsers()->pluck('email')->toArray();
        $email_admin = $this->choice('Choice delete  Admin', $roleList);

        try {
            if ($this->confirm('Do you wish delete')) {
                $this->roleservice->delete($email_admin);
                $this->alert('Admin  --' .$email_admin  .' delete');
            }
            else{
                $this->alert('Admin  --' .$email_admin  .' stay');
            }


        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }
        return 0;
    }


}
