<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class CategoryList
{
    /** @var \NetworkRailBusinessSystems\BravoApi\RequestObjects\Category[]  */
    public ?array $category = null;

    public function toArray(): array
    {
        $categories = [];

        if ($this->category !== null) {
            foreach ($this->category as $key => $category) {
                $categories[$key]['categoryCode'] = $category->categoryCode;
                $categories[$key]['categoryName'] = $category->categoryName;
            }
        }

        return [
            'category' => $categories,
        ];
    }
}
