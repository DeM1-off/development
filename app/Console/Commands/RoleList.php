<?php


namespace App\Console\Commands;


use App\Models\Role;
use App\Http\Service\Role\RoleServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RoleList
 * @package App\Console\Commands
 */
class RoleList extends  Command
{
    /**
     * @var string
     */
    protected $signature = 'role:list';

    /**
     * @var string
     */
    protected $description = 'Show all admin';


    /**
     * @var  RoleServiceInterface $roleservice
     */
    private  $roleservice;

    /**
     * RoleList constructor.
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
        $role = $this->roleservice->list();
        $data = [];
        /**
         * @var Role $data
         */

        foreach ($role as $item) {
            $data[] = [
                'id' => $item->id,
                'email_admin' => $item->email_admin,
                'role_id' => $item->role_id

            ];
        }
        $this->table(
            ['id','email_admin', 'role_id'],
            $data
        );

        return 0;
    }



}
