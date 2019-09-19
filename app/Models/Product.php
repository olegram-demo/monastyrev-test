<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class Product
 * @package App\Models
 */
class Product extends BaseModel
{
    /**
     * @var int
     */
   protected $id;

    /**
     * @var string
     */
   protected $title;

    /**
     * @var int
     */
   protected $price;

    /**
     * @var string|null
     */
   protected $descriptionTemplate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;
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
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return Product
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string|null
     */
    protected function getDescriptionTemplate(): ?string
    {
        return $this->descriptionTemplate;
    }

    /**
     * @param string|null $descriptionTemplate
     * @return Product
     */
    public function setDescriptionTemplate(?string $descriptionTemplate): Product
    {
        $this->descriptionTemplate = $descriptionTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        $map = [
            '%наименование%' => $this->getTitle(),
            '%цена%' => $this->getPrice(),
            '%name%' => $this->getTitle(),
        ];

        $description = str_replace(array_keys($map), array_values($map), $this->getDescriptionTemplate());

        return preg_replace('/%.*?%/', 'UNDEFINED', $description);
    }
}
