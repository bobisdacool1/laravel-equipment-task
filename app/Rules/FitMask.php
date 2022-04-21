<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FitMask implements Rule
{
    private string $mask;
    protected array $availableMasks = [
        'N' => '[0-9]',
        'A' => '[A-Z]',
        'a' => '[a-z]',
        'X' => '[A-Z]|[0-9]',
        'Z' => '-|_|@',
    ];

    /**
     * FitMask constructor.
     * @param string $mask
     */
    public function __construct(string $mask)
    {
        $this->mask = $mask;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        for ($i = 0; $i < strlen($value); $i++) {
            $regexp = $this->availableMasks[$this->mask[$i]];

            if (preg_match("%$regexp%", $value[$i]) !== 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must fit the \"$this->mask\" mask.";
    }
}
