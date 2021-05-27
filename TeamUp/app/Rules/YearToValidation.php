<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class YearToValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public $from;
    public $to;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value)
    {
        if($this->checkValid($value)){
            for ($i = 0; $i < count($this->from); $i++){
                if (intval(($this->from)[$i]) 
                    > intval((($this->to)[$i] == "Now") ? date("Y") : ($this->to)[$i])){
                    return false;
                };
            }
            return true;
        }
        return false;
    }

    public function checkValid($value){
        if(is_numeric($value)){
            return intval($value) >= 1900 && intval($value) <= date('Y');
        } 
        return $value == 'Now';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
