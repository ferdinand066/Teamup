<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdInData implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        //
        $this->param = $param;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    private $param;

    public function passes($attribute, $value)
    {
        if ($this->param == []) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid :attribute Id.';
    }
}
