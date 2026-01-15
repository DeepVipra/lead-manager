<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = Lead::query();

        // Date filter
        if (!empty($this->filters['from_date']) && !empty($this->filters['to_date'])) {
            $query->whereBetween('lead_date', [
                $this->filters['from_date'],
                $this->filters['to_date']
            ]);
        }

        // Country filter
        if (!empty($this->filters['country'])) {
            $query->where('country', $this->filters['country']);
        }

        // Service filter
        if (!empty($this->filters['service'])) {
            $query->where('service', $this->filters['service']);
        }

        return $query->select([
            'lead_date',
            'month',
            'client_name',
            'email',
            'contact_number',
            'country',
            'service',
            'website',
            'reply',
        ])->orderBy('lead_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Month',
            'Client Name',
            'Email',
            'Contact Number',
            'Country',
            'Service',
            'Website',
            'Reply',
        ];
    }
}
