<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64Image implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Validate base64 format and extract data
        if (!preg_match('/^data:image\/(\w+);base64,/', $value, $matches)) {
            $fail('The ' . $attribute . ' must be a valid base64-encoded image.');
            return;
        }

        // Extract base64 data
        $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $value);
        $imageData = base64_decode($base64Data, true);

        // Check if base64 decoding was successful
        if ($imageData === false) {
            $fail('The ' . $attribute . ' could not be decoded.');
            return;
        }

        // Check if the decoded data is a valid image
        $image = @imagecreatefromstring($imageData);
        if ($image === false) {
            $fail('The ' . $attribute . ' is not a valid image.');
            return;
        }

        imagedestroy($image);
    }

    public function message(): string
    {
        // Default error message
        return 'The :attribute is not a valid base64-encoded image.';
    }
}
