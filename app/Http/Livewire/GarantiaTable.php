<?php

namespace App\Http\Livewire;

use App\Models\Garantia;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use App\Models\Cliente;
use App\Models\Prestamo;

final class GarantiaTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Garantia>
    */
    public function datasource(): Builder
    {
        return Garantia::query()
            ->join('clientes', 'garantias.id_cliente', '=', 'clientes.id')
            ->join('prestamo', 'garantias.id_prestamo', '=', 'prestamo.id')
            ->select([
                'garantias.*',
                'clientes.nombre_cliente as cliente_nombre_cliente',
                'clientes.apellido_cliente as cliente_apellido_cliente',
                'prestamo.monto_prestamo',
                'prestamo.id as id_prestamo',
            ])
            ->distinct();
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
        return PowerGrid::eloquent(Garantia::query()
            ->select('garantias.*', 'clientes.nombres', 'clientes.apellidos', 'prestamos.monto_prestamo', 'prestamos.id as id_prestamo')
            ->join('clientes', 'garantias.id_cliente', '=', 'clientes.id')
            ->join('prestamo', 'garantias.id_prestamo', '=', 'prestamo.id')
            ->orderBy('garantias.fecha_entrega', 'DESC')
        )
        ->addColumn('id')
        ->addColumn('garantia')
        ->addColumn('Valor_Prenda')
        ->addColumn('Detalle_Prenda')
        ->addColumn('id_cliente', function (Garantia $model) {
            return $model->cliente->nombre_cliente;
        })
        ->addColumn('nombre_cliente', function (Garantia $model) {
            return $model->cliente->nombre_cliente;
        })
        ->addColumn('apellido_cliente', function (Garantia $model) {
            return $model->cliente->apellido_cliente;
        })
        ->addColumn('monto_prestamo')
        ->addColumn('id_prestamo')
        ->addColumn('id_foto')
        ->addColumn('fecha_entrega_formatted', fn (Garantia $model) => Carbon::parse($model->fecha_entrega)->format('d/m/Y'))
        ->addColumn('estado');
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
         /*    Column::make('ID', 'id')
                ->makeInputRange(), */

            Column::make('GARANTIA', 'garantia')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('VALOR PRENDA', 'Valor_Prenda')
                ->sortable()
                ->searchable()
                ->makeInputText(),


            Column::make('DETALLE PRENDA', 'Detalle_Prenda')
                ->sortable()
                ->searchable()
                ->makeInputText(),

        /*     Column::make('ID CLIENTE', 'id_cliente')
                ->makeInputRange(),

            Column::make('ID PRESTAMO', 'id_prestamo')
                ->makeInputRange(), */
            Column::make('NOMBRE CLIENTE', 'nombre_cliente')
                ->searchable()
                ->sortable()
                ->makeInputText(),

            Column::make('NOMBRE CLIENTE', 'apellido_cliente')
                ->searchable()
                ->sortable()
                ->makeInputText(),

            Column::make('MONTO PRÉSTAMO', 'monto_prestamo')
                ->searchable()
                ->sortable()
                ->makeInputText(),

     /*        Column::make('ID FOTO', 'id_foto')
                ->makeInputRange(), */

            Column::make('FECHA ENTREGA', 'fecha_entrega_formatted', 'fecha_entrega')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('ESTADO', 'estado')
                ->sortable()
                ->searchable()
                ->makeInputText(),

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
     * PowerGrid Garantia Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('garantia.edit', ['garantia' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('garantia.destroy', ['garantia' => 'id'])
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
     * PowerGrid Garantia Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($garantia) => $garantia->id === 1)
                ->hide(),
        ];
    }
    */
}
