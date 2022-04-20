<?php

namespace App\Http\Requests\Equipment;

use App\Rules\ColumnExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EquipmentIndexRequest extends FormRequest
{
    public function authorize()
    {
        if (!Auth::check()) {
            abort(403);
        }

        return true;
    }

    public function rules()
    {
        return [
            'count' => 'int',
            'sort_order' => 'in:asc,desc',
            'sort_by' => [
                'string',
                new ColumnExists('equipment'),
            ],
            'search' => 'array',
            'search_pivot' => 'array',
            'page' => 'int'
        ];
    }
}
