<?php

namespace App\Http\Requests\Penerimaan;

use Illuminate\Foundation\Http\FormRequest;

class CreatePenerimaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_po' => 'required|integer',
            'nama_sup' => 'required|string',
            'alamat_sup' => 'required|string',
            'tanggal_diterima' => 'required|date',
            'id_barang' => 'required|integer',
            'qty_barang' => 'required|integer',
            'no_so' => 'required|string',
        ];
    }
}
