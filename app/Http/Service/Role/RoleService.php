<?php


namespace App\Http\Service\Role;


use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RoleService
 * @package App\Http\Service\Role
 */
class RoleService implements RoleServiceInterface
{
    /**
     * @param array $data
     */
    public function add(array $data): void
    {
            /**
             * @param User  $user_add
             */
        $user_add = $this->getByEmail($data['role_id']);
        if(!$user_add){
        throw new \InvalidArgumentException('User does not exists');
        }

        $rols = new Role();
        $rols->email_admin = $data['role_id'];
        $rols->role()->associate($user_add)->save();
    }

    /**
     * @param  string $emailAdmin
     */
    public function delete(string $emailAdmin): void
    {
            $role = Role::where('email_admin', '=', $emailAdmin)->first();
            $role->delete();

    }


    /**
     * @param string $email
     * @return User
     */
    public function getByEmail(string $email): User
    {
        return  User::where('email', '=', $email)->first();
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {

        return  User::all('email');
    }


    /**
     * @return Collection|null
     */
    public function list(): ?Collection
    {
        return  Role::all();
    }
}
