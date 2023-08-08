<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PagoTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
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

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Pago>
    */
    public function datasource(): Builder
    {
        return Pago::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('nombre_cliente', fn (Pago $model) => $model->prestamo->cliente->nombre_cliente)
            ->addColumn('apellido_cliente', fn (Pago $model) => $model->prestamo->cliente->apellido_cliente)
            ->addColumn('id_prestamo', fn (Pago $model) => $model->prestamo->monto_prestamo)
            ->addColumn('fecha_pago_formatted', fn (Pago $model) => Carbon::parse($model->fecha_pago)->format('d/m/Y'))
            ->addColumn('estado')
            ->addColumn('Numero_Cuota')
            ->addColumn('monto_pago')
            ->addColumn('descripcion');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
           /*  Column::make('ID', 'id')
                ->makeInputRange(),
 */
            Column::make('NOMBRES', 'nombre_cliente')
            ->makeInputRange(),

            Column::make('APELLIDOS', 'apellido_cliente')
            ->makeInputRange(),

            Column::make('MONTO PRESTAMO', 'id_prestamo')
                ->makeInputRange(),

            Column::make('FECHA PAGO', 'fecha_pago_formatted', 'fecha_pago')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

         /*    Column::make('ESTADO', 'estado')
                ->toggleable(), */

            Column::make('CUOTA PAGADA', 'Numero_Cuota')
                ->makeInputRange(),

            Column::make('MONTO PAGO', 'monto_pago')
                ->sortable()
                ->searchable(),

            Column::make('DESCRIPCION', 'descripcion')
                ->sortable()
                ->searchable(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Pago Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('pago.edit', ['pago' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('pago.destroy', ['pago' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Pago Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($pago) => $pago->id === 1)
                ->hide(),
        ];
    }
    */
}
