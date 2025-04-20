<?php

namespace App\Http\Requests\Traits;

use Carbon\Carbon;

trait SanitizesMemberData
{
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        foreach (['birth_date', 'baptism_date', 'admission_date', 'wedding_date'] as $field) {
            if (!empty($data[$field])) {
                $data[$field] = Carbon::createFromFormat('d/m/Y', $data[$field]);
            }
        }

        foreach (['phone_number', 'cellphone'] as $field) {
            if (!empty($data[$field])) {
                $data[$field] = preg_replace('/\D/', '', $data[$field]);
            }
        }

        return $data;
    }
}
