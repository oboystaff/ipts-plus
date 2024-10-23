<?php

namespace App\Imports;

use App\Models\PaymentTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class PaymentInvoiceImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, WithEvents
{
    use Importable, RegistersEventListeners;

    public function __construct() {}

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PaymentTemp([
            'SN' => $row['sn'],
            'Account' => $row['account'] ?? null,
            'Address' => $row['address'] ?? null,
            'OwnerName' => $row['owner_name'] ?? null,
            'Suburb' => $row['suburb'] ?? null,
            'RateableV' => $row['rateable_v'] ?? null,
            'Zone' => $row['zone'] ?? null,
            'Use_' => $row['use'] ?? null,
            'Rate' => $row['rate'] ?? null,
            'CurrentRate' => $row['current_rate'] ?? null,
            'BasicRate' => $row['basic_rate'] ?? null,
            'Arrears' => $row['arrears'] ?? null,
            'Balance' => $row['balance'] ?? null
        ]);
    }

    public function rules(): array
    {
        return [];
    }

    public static function beforeImport(BeforeImport $event)
    {
        if ($event->getReader()->getActiveSheet()->getHighestRow() <= 1) {
            throw ValidationException::withMessages([
                'file' => 'You cannot upload an empty excel sheet.',
            ]);
        }
    }
}
