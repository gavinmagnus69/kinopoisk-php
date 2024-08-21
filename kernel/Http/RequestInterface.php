<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\Validator;

interface RequestInterface {

    public static function createFromGlobals(): static;

    public function uri(): string;

    public function setValidator(Validator $validator): void;

    public function validate(array $rules): bool;

    public function errors(): array;

};

?>