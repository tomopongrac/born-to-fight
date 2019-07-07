<?php

declare(strict_types=1);

namespace App\Validation;

use Illuminate\Support\MessageBag;
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

    /**
     * Perform validation.
     *
     * @param  Request  $request
     */
    public function make(Request $request): void
    {
        $this->validator = $this->validator->make($request->all(), [
            'army1' => 'required|integer|min:1',
            'army2' => 'required|integer|min:1',
        ], $this->messages());
    }

    /**
     * Check if validation was failed.
     *
     * @return bool
     */
    public function fails(): bool
    {
        return $this->validator->fails();
    }

    /**
     * Returns validated attributes with values.
     *
     * @return array
     */
    public function getValidatedFields(): array
    {
        return $this->validator->validated();
    }

    /**
     * Returns objects with errors messsages
     *
     * @return MessageBag
     */
    public function errors(): MessageBag
    {
        return $this->validator->errors();
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    private function messages(): array
    {
        return [
            'required' => 'The :attribute parameter is required.',
        ];
    }
}
