<?php

namespace App\Livewire;

use App\Models\Estate;
use App\Models\Village;
use App\Models\Rental;
use App\Models\User;
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
use PowerComponents\LivewirePowerGrid\Responsive;

final class EstateTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Responsive::make(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage(25)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();
    
        if ($user->role === 'Admin') {
            return Estate::query()->with('rentalEstate','villageEstate');
        } else {
            return Estate::query()->with('rentalEstate','villageEstate')
                ->where('landlord_id', $user->id)
                ->orWhere('broker_id', $user->id);
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('uid')
            ->addColumn('rental_id', function (Estate $estate) {
                return $estate->rentalEstate->name;
            })
            ->addColumn('estate')
            ->addColumn('broker_id')
            ->addColumn('village_id', function (Estate $estate) {
                return $estate->villageEstate->village;
            })     
            ->addColumn('latitude')
            ->addColumn('longitude')
            ->addColumn('unit_no')
            ->addColumn('status', function (Estate $model) {
                $statusText = ($model->status == 1) ? 'Active' : 'Inactive';
                $statusColor = ($model->status == 1) ? 'blue' : 'red';
                $statusUrl = route('rental.status', $model->slug); 
                return "<a href='$statusUrl' style='color: $statusColor'>$statusText</a>";
            })            
            ->addColumn('created_at_formatted', fn (Estate $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'uid'),
            Column::make('Rental Type', 'rental_id')
                ->sortable()
                ->searchable(),
            Column::make('Estate', 'estate')->searchable()
                ->sortable(),
            Column::make('Broker', 'broker_id')
                ->searchable()
                ->sortable(),
            Column::make('Village', 'village_id')
                ->searchable()
                ->sortable(),
            Column::make('Latitude', 'latitude')
                ->sortable(),
            Column::make('Longitude', 'longitude')
                ->sortable(),
                
            Column::make('Status', 'status')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        
        return [
            Filter::inputText('estate')->operators(['contains']),
            // Filter::inputText('village_id')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        redirect()->route('estate-edit', $rowId);
    }

    public function actions(\App\Models\Estate $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('bg-green-500 text-white rounded py-1 px-3')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    public function header(): array
    {
        return [
            Button::add('new_estate')
                ->slot('New Estate')
                ->class('bg-gray-300 rounded py-1 px-3')
                ->dispatch('create', []),
        ];
    }

    #[\Livewire\Attributes\On('create')]
    public function create(): void
    {
        $this->js('createEstate()');
    }
}
