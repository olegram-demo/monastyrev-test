<?php

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\GroupNotFoundException;

/**
 * Class Category
 * @package App\Models
 */
class GroupList extends BaseModel
{
    /**
     * @var Group[]
     */
    protected $groups = [];

    /**
     * @param Group $group
     * @return $this
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
        return $this;
    }

    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    public function findGroupByIdOrFail(int $id): Group
    {
        $result = $this->findGroupById($id);

        if (is_null($result)) {
            throw new GroupNotFoundException("Group with id ${id} not found.");
        }

        return $result;
    }

    public function findGroupById(int $id): ?Group
    {
        foreach ($this->groups as $group) {
            if ($group->getId() === $id) {
                return $group;
            }

            $childGroup = $group->findGroupById($id);
            if ($childGroup) {
                return  $childGroup;
            }
        }

        return null;
    }
}
