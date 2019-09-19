<?php

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\GroupNotFoundException;

/**
 * Class Group
 * @package App\Models
 */
class Group extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string|null
     */
    protected $descriptionTemplate;

    /**
     * @var bool
     */
    protected $isInheritDescriptionAllowed = false;

    /**
     * @var Group[]
     */
    protected $groups = [];

    /**
     * @var Product[]
     */
    protected $products = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Group
     */
    public function setId(int $id): Group
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Group
     */
    public function setLevel(int $level): Group
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Group
     */
    public function setTitle(string $title): Group
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionTemplate(): ?string
    {
        return $this->descriptionTemplate;
    }

    /**
     * @param string $descriptionTemplate
     * @return Group
     */
    public function setDescriptionTemplate(?string $descriptionTemplate): Group
    {
        $this->descriptionTemplate = $descriptionTemplate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInheritDescriptionAllowed(): bool
    {
        return $this->isInheritDescriptionAllowed;
    }

    /**
     * @return Group
     */
    public function allowInheritDescription(): Group
    {
        $this->isInheritDescriptionAllowed = true;
        return $this;
    }

    /**
     * @param Group $group
     * @return $this
     */
    public function addGroup(Group $group): self
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

    /**
     * @param int $id
     * @return Group|null
     */
    public function findGroupById(int $id): ?Group
    {
        foreach ($this->getGroups() as $group) {
            if ($group->id === $id) {
                return $group;
            }

            $childGroup = $group->findGroupById($id);
            if ($childGroup) {
                return $childGroup;
            }
        }

        return null;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
