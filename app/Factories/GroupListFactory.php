<?php

declare(strict_types=1);

namespace App\Factories;

use App\Models\Group;
use App\Models\GroupList;
use App\Models\Product;

class GroupListFactory
{
    /**
     * @param string $groupCsvFilename
     * @param string $productsCsvFilename
     * @return GroupList
     * @throws \App\Exceptions\GroupNotFoundException
     */
    public static function createFromCsvFiles(string $groupCsvFilename, string $productsCsvFilename)
    {
        $groupList = new GroupList();

        foreach (parse_csv($groupCsvFilename) as $groupData) {
            $group = new Group();
            $group
                ->setId((int)$groupData[0])
                ->setTitle($groupData[1]);

            if ($groupData[3]) {
                $group->setDescriptionTemplate($groupData[3]);
            }

            if ($groupData[4]) {
                $group->allowInheritDescription();
            }

            if ($groupData[2]) {
                $parentGroup = $groupList->findGroupByIdOrFail((int)$groupData[2]);

                if (is_null($group->getDescriptionTemplate()) && $parentGroup->isInheritDescriptionAllowed()) {
                    $group->setDescriptionTemplate($parentGroup->getDescriptionTemplate());
                }

                $group->setLevel($parentGroup->getLevel() + 1);

                $parentGroup->addGroup($group);
            } else {
                $group->setLevel(0);
                $groupList->addGroup($group);
            }
        }

        foreach (parse_csv($productsCsvFilename) as $productData) {
            $product = new Product();
            $product->setId((int)$productData[0]);
            $product->setTitle($productData[2]);
            $product->setPrice((int)$productData[3]);

            $group = $groupList->findGroupByIdOrFail((int)$productData[1]);
            $product->setDescriptionTemplate($group->getDescriptionTemplate());
            $group->addProduct($product);
        }

        return $groupList;
    }
}
