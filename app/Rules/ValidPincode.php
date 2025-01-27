<?php 

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ValidPincode implements Rule
{
    public function passes($attribute, $value)
    {
        // Call the API
        $response = Http::get("https://api.postalpincode.in/pincode/{$value}");

        if ($response->ok()) {
            $data = $response->json();

            // Check if the API returned valid data
            if (!empty($data) && $data[0]['Status'] === 'Success') {
                return true;
            }
        }

        return false; // Invalid pincode
    }

    public function message()
    {
        return 'The :attribute is not a valid Indian pincode.';
    }
}