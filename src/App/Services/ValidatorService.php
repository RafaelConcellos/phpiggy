<?php
#ValidatorService

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{RequiredRules};
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRules());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData);
    }
}
