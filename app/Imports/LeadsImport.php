<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class LeadsImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Prevent duplicate emails
     */
    public function uniqueBy()
    {
        return 'email';
    }

    /**
     * Map Excel row to database
     */
    public function model(array $row)
    {
        // 🚨 HARD STOP: Skip row if email is empty
        if (
            !isset($row['email']) ||
            trim($row['email']) === ''
        ) {
            return null;
        }

        return new Lead([
            'lead_date'      => $row['date'] ?? null,
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
