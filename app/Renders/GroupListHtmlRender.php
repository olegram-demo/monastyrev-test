<?php

declare(strict_types=1);

namespace App\Renders;

use App\Models\Group;
use App\Models\GroupList;

class GroupListHtmlRender
{
    /**
     * @var string
     */
    protected $spacer;

    /**
     * GroupListHtmlRender constructor.
     * @param Spacer $spacer
     */
    public function __construct(Spacer $spacer)
    {
        $this->spacer = $spacer;
    }

    /**
     * @param GroupList $list
     * @return string
     */
    public function render(GroupList $list): string
    {
        $html = new HtmlDocument();

        if (! empty($list->getGroups())) {
            $html->print("<ul>\n");
            foreach ($list->getGroups() as $group) {
                $this->printGroup($html, $group);
            }
            $html->print("</ul>\n");
        }

        return $html->render();
    }

    /**
     * @param HtmlDocument $html
     * @param Group $group
     */
    protected function printGroup(HtmlDocument $html, Group $group)
    {
        $tag = 'h' . ($group->getLevel() + 1);
        $p = $group->getLevel() * 2 + 1;

        $html->print($this->p($p) . "<li>\n");
        $html->print($this->p($p+1) . "<$tag>{$group->getTitle()}</$tag>\n");

        if (! empty($group->getGroups()) || ! empty($group->getProducts())) {
            $html->print($this->p($p+1) . "<ul>\n");
            foreach ($group->getProducts() as $product) {
                $html->print($this->p($p+2) . "<li>\n");
                $html->print($this->p($p+3) . "<b>{$product->getDescription()}</b>\n");
                $html->print($this->p($p+2) . "</li>\n");

            }
            foreach ($group->getGroups() as $childGroup) {
                $this->printGroup($html, $childGroup);
            }
            $html->print($this->p($p+1) . "</ul>\n");
        }

        $html->print($this->p($p) . "</li>\n");
    }

    /**
     * @param int $value
     * @return string
     */
    protected function p(int $value): string
    {
        return str_repeat($this->spacer->render(), $value);
    }
}
