<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
        'numeric' => 'The :attribute must be at least :min.',
    ],
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'email' => 'The :attribute must be a valid email address.',
    'numeric' => 'The :attribute must be a number.',
    'digits' => 'The :attribute must be :digits digits.',
    'date' => 'The :attribute is not a valid date.',
    'after' => 'The :attribute must be a date after :date.',
    'exists' => 'The selected :attribute is invalid.',
    'unique' => 'The :attribute has already been taken.',
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'regex' => 'The :attribute format is invalid.',
    'accepted' => 'You must accept the :attribute.',
    'forgot_password' => 'You forgot your password?',

    // Agent custom messages
    'custom' => [
        // Auth/Login/Signup
        'email' => [
            'required' => 'The email field is required.',
            'email' => 'Enter a valid email address.',
            'max' => 'The email may not be greater than :max characters.',
        ],
        'phone' => [
            'required' => 'The phone number field is required.',
            'regex' => 'Enter a valid phone number.',
            'min' => 'The phone number must be at least :min digits.',
        ],
        'password' => [
            'required' => 'The password field is required.',
            'min' => 'The password must be at least :min characters.',
            'confirmed' => 'The password confirmation does not match.',
        ],
        'password_confirmation' => [
            'required' => 'The password confirmation field is required.',
        ],
        'terms' => [
            'accepted' => 'You must accept the terms of use.',
        ],
        'otp' => [
            'required' => 'The verification code is required.',
            'digits' => 'The verification code must be :digits digits.',
        ],
        'code' => [
            'required' => 'The verification code is required.',
            'digits' => 'The verification code must be :digits digits.',
        ],
        'name' => [
            'required' => 'The name field is required.',
            'string' => 'The name must be a string.',
            'max' => 'The name may not be greater than 255 characters.',
        ],
        'description' => [
            'string' => 'The description must be a string.',
        ],
        'is_active' => [
            'boolean' => 'The status must be true or false.',
        ],
        'user_id' => [
            'required' => 'The user field is required.',
            'exists' => 'The selected user is invalid.',
            'unique' => 'The user has already been taken.',
        ],
        'full_name' => [
            'required' => 'The full name field is required.',
            'string' => 'The full name must be a string.',
            'max' => 'The full name may not be greater than 255 characters.',
        ],
        'agent_type_id' => [
            'required' => 'The agent type field is required.',
            'exists' => 'The selected agent type is invalid.',
        ],
        'phone_number' => [
            'string' => 'The phone number must be a string.',
            'max' => 'The phone number may not be greater than 20 characters.',
        ],
        'email' => [
            'email' => 'The email must be a valid email address.',
            'max' => 'The email may not be greater than 255 characters.',
        ],
        'license_number' => [
            'string' => 'The license number must be a string.',
            'max' => 'The license number may not be greater than 255 characters.',
        ],
        'license_issue_date' => [
            'date' => 'The license issue date is not a valid date.',
        ],
        'license_expiry_date' => [
            'date' => 'The license expiry date is not a valid date.',
            'after' => 'The license expiry date must be after the license issue date.',
        ],
        'national_id' => [
            'string' => 'The national ID must be a string.',
            'max' => 'The national ID may not be greater than 255 characters.',
        ],
        'address' => [
            'string' => 'The address must be a string.',
        ],
        'agency_id' => [
            'exists' => 'The selected agency is invalid.',
        ],
    ],
    'attributes' => [
        'name' => 'Name',
        'description' => 'Description',
        'is_active' => 'Status',
        'user_id' => 'User',
        'full_name' => 'Full Name',
        'agent_type_id' => 'Agent Type',
        'agency_id' => 'Agency',
        'phone_number' => 'Phone Number',
        'phone' => 'Phone Number',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'otp' => 'Verification Code',
        'code' => 'Verification Code',
        'terms' => 'Terms of Use',
        'license_number' => 'License Number',
        'license_issue_date' => 'License Issue Date',
        'license_expiry_date' => 'License Expiry Date',
        'national_id' => 'National ID',
        'address' => 'Address',
        'commercial_register_number' => 'Commercial Register Number',
        'commercial_issue_date' => 'Commercial Register Issue Date',
        'commercial_expiry_date' => 'Commercial Register Expiry Date',
        'city' => 'City',
    ],
]; 