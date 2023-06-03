<?php

namespace App\Service;

class TestCollection
{
    private array $items = [];

    public function __construct()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->items[$i] = ['id' => $i, 'name' => 'VALUE ' . $i];
        }
    }

    public function getPage(int $page, array|null $filter = null)
    {
        $filteredItems = [];
        foreach ($this->items as $item) {
            if ($item['id'] > $filter['id']) {
                $filteredItems[] = $item;
            }
        }
        return [
            'currentPage' => $page,
            'totalCount' => count($filteredItems),
            'numberOfPages' => intdiv(count($filteredItems), 10),
            'items' => array_slice($filteredItems, ($page - 1) * 10, 10)
        ];
    }
}