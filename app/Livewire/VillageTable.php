<?php

namespace App\Livewire;

use App\Models\Village;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class VillageTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Village::with('parishName')->latest();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('uid')
            ->addColumn('village')
            ->addColumn('parish_id', function (Village $village) {
                return $village->parishName->parish;
            })  
            ->addColumn('status', function (Village $model) {
                $statusText = ($model->status == 1) ? 'Active' : 'Inactive';
                $statusColor = ($model->status == 1) ? 'green' : 'red';
                $statusUrl = route('village.status', $model->slug); 
                return "<a href='$statusUrl' style='color: $statusColor'>$statusText</a>";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'uid'),

            Column::make('Village/Cell', 'village')
                ->sortable()
                ->searchable(),

            Column::make('Parish/Ward', 'parish_id')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('village')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $village = Village::where('id', $rowId)->first();
        $this->js('editVillageModal('.$village.')');
    }

    public function actions(\App\Models\Village $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
