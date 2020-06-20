<?php


namespace App\Console\Commands;


use App\Http\Service\Role\RoleServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RoleAdd
 * @package App\Console\Commands
 */
class RoleAdd extends Command
{

    /**
     * @var string
     */
    protected $signature = 'role:add ';

    /**
     * @var string
     */
    protected $description = 'New add admin';

    /**
     * @var  RoleServiceInterface $roleservice
     */
    private  $roleservice;

    /**
     * RoleAdd constructor.
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
        $email_admin = $this->choice('Email add Admin', $roleList);
        $data = compact('email_admin');
        $data['role_id'] = $email_admin;

        try {
            $this->roleservice->add($data);
            $this->alert('New Admin --'. $email_admin .' Add');

        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }
        return 0;

    }


}
