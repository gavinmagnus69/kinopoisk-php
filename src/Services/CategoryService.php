<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Category;

class CategoryService {

    public function __construct(
        private DatabaseInterface $db
    )
    {
        
    }
    public function all(): array {

        $rawCategories = $this->db->get('categories', []);

        $categories = [];

        foreach($rawCategories as $key){
            array_push($categories, new Category(
                $key[0],
                $key[1],
                $key[2],
                $key[3], 
            ));
        }

        return $categories;
    }

    public function destroy(int $id) {
        $this->db->remove('categories', [
            'id' => $id
        ]);
    }

    public function store(string $name): int {
        return $this->db->insert('categories',
        [
            'name' => $name,
        ]);

    }
}