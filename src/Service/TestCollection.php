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
        return array_slice($this->items, ($page - 1) * 10, 10);
    }
}