<?php

declare(strict_types=1);

namespace App\Validation;

use Illuminate\Validation\Factory;
use Validator;
use Illuminate\Http\Request;

class ArmyValidator
{
    private $validator;

    /**
     * ArmyValidator constructor.
     *
     * @param  Factory  $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    public function make(Request $request)
    {
        $this->validator = $this->validator->make($request->all(), [
            'army1' => 'required|integer',
            'army2' => 'required|integer',
        ], $this->messages());
    }

    public function fails()
    {
        return $this->validator->fails();
    }

    public function getValidatedFields()
    {
        return $this->validator->validated();
    }

    public function errors()
    {
        return $this->validator->errors();
    }

    private function messages()
    {
        return [
            'required' => 'The :attribute parameter is required.',
        ];
    }
}
