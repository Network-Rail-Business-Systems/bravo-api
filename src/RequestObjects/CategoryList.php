<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class CategoryList
{
    /** @var \NetworkRailBusinessSystems\BravoApi\RequestObjects\Category[]  */
    public $category;

    public function toArray(): array
    {
        $categories = [];

        if (isset($this->category)) {
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
