<?php


namespace App\Http\Service\Role;


use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RoleServiceInterface
 * @package App\Service\Role
 */
interface RoleServiceInterface
{
    /**
     * @param array $data
     */
    public function add(array $data): void;

    /**
     * @param string $email_admin
     */
    public function delete(string $email_admin) : void;

    /**
     * @return Collection|null
     */
    public function list() : ?Collection;

    /**
     * @param string $email
     * @return User
     */

    public function getByEmail(string $email): User;

    /**
     * @return Collection
     */
    public function getUsers(): Collection;

}
