<?php


namespace App\Models;


class Category {
    public function __construct(
        private int $id,
        private string $name,
        private string $created_at,
        private string $updated_at,
    )
    {
        
    }

    public function id(): int {
        return $this->id;
    }

    public function name(): string {
        return $this->name;
    }

    public function created_at(): string {
        return $this->created_at;
    }

    public function updated_at(): string {
        return $this->updated_at;
    }
    
}