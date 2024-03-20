<?php

namespace App\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseOrderRequest extends FormRequest
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
            'id_so' => 'required|integer',
            'nama_customer' => 'required|string',
            'alamat_customer' => 'required|string',
            'date_po' => 'required|date',
            'id_barang' => 'required|integer',
            'qty_barang' => 'required|integer',
        ];
    }
}
