<?php

namespace App\Http\Requests\Equipment;

use App\Rules\ColumnExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EquipmentIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) {
            abort(403);
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
            'page' => 'int'
        ];
    }
}
