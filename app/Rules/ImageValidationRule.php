<?php

// app/Rules/ImageValidationRule.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

        $extension = strtolower(pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION));

        return in_array($extension, $allowedExtensions);
    }

    public function message()
    {
        return 'The :attribute must be a valid image file (png, jpg, jpeg, gif).';
    }

    // This method is required by the Rule interface
    public function validate($attribute, $value, $parameters, $validator)
    {
        // Add any additional validation logic if needed
        return $this->passes($attribute, $value);
    }
}

