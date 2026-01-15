<?php

namespace App\Imports;

use App\Models\Lead;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class LeadsImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function uniqueBy()
    {
        return 'email';
    }

    public function model(array $row)
    {
        // Skip row if email is missing
        if (!isset($row['email']) || trim($row['email']) === '') {
            return null;
        }

        // -------- DATE HANDLING (CRITICAL FIX) --------
        $leadDate = null;

        if (!empty($row['date'])) {
            try {
                // Case 1: Excel numeric date
                if (is_numeric($row['date'])) {
                    $leadDate = Carbon::instance(
                        \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date'])
                    );
                }
                // Case 2: DD/MM/YY or DD/MM/YYYY
                elseif (preg_match('#^\d{1,2}/\d{1,2}/\d{2,4}$#', $row['date'])) {
                    $leadDate = Carbon::createFromFormat('d/m/y', $row['date'], null);
                }
                // Case 3: Fallback (YYYY-MM-DD etc.)
                else {
                    $leadDate = Carbon::parse($row['date']);
                }
            } catch (\Exception $e) {
                $leadDate = null; // silently ignore bad date
            }
        }

        return new Lead([
            'lead_date'      => $leadDate,
            'month'          => $row['month'] ?? null,
            'client_name'    => $row['client_name'] ?? null,
            'email'          => strtolower(trim($row['email'])),
            'contact_number' => $row['contact_number'] ?? null,
            'country'        => $row['country'] ?? 'Others',
            'service'        => $row['service'] ?? null,
            'website'        => $row['website'] ?? null,
            'reply'          => $row['reply'] ?? null,
        ]);
    }
}
