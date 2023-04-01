<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Interes;
use App\Models\ModoPago;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PrestamoTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Prestamo>
    */
    public function datasource(): Builder
    {
        return Prestamo::query()
            ->join('clientes', function ($join) {
                $join->on('prestamo.id_cliente', '=', 'clientes.id');
            })
            ->join('users', function ($join) {
                $join->on('prestamo.id_usuario', '=', 'users.id');
            })
            ->join('intereses', function ($join) {
                $join->on('prestamo.id_interes', '=', 'intereses.id');
            })
            ->join('modo_pago', function ($join) {
                $join->on('prestamo.id_modo_pago', '=', 'modo_pago.id');
            })
            ->select([
                'prestamo.*',
                'clientes.nombre_cliente as cliente_nombre_cliente',
                'users.name as nombre_usuario',
                'intereses.interes_prestamo',
                'modo_pago.modalidad_pago',
            ])
            ->distinct(); // Agrega esta línea para eliminar filas duplicadas
    }
/*

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
            ->addColumn('monto_prestamo')
            ->addColumn('duracion_prestamo')

           /** Example of custom column using a closure **/
            ->addColumn('duracion_prestamo_lower', function (Prestamo $model) {
                return strtolower(e($model->duracion_prestamo));
            })

            ->addColumn('calculo_cuota')
            ->addColumn('garantia')
            ->addColumn('cantidad_cuotas')
            ->addColumn('monto_cancelado')
            ->addColumn('monto_prestado')
            ->addColumn('id_cliente')
            ->addColumn('id_usuario')
            ->addColumn('id_interes')
            ->addColumn('id_modo_pago')
            ->addColumn('fecha_prestamo_formatted', fn (Prestamo $model) => Carbon::parse($model->fecha_prestamo)->format('d/m/Y'));
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
            Column::make('ID', 'id')
                ->makeInputRange(),

            Column::make('MONTO PRESTAMO', 'monto_prestamo')
                ->sortable()
                ->searchable(),

            Column::make('DURACION PRESTAMO', 'duracion_prestamo')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CALCULO CUOTA', 'calculo_cuota')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('GARANTIA', 'garantia')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CANTIDAD CUOTAS', 'cantidad_cuotas')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('MONTO CANCELADO', 'monto_cancelado')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('MONTO PRESTADO', 'monto_prestado')
                ->sortable()
                ->searchable()
                ->makeInputText(),



            Column::make(__('ID CLIENTE'), 'cliente_nombre_cliente', 'clientes_nombre_cliente')
            ->makeInputMultiSelect(Cliente::all(), 'name', 'id_cliente')
            ->sortable(),
/*
            Column::make('ID USUARIO', 'id_usuario')
                ->makeInputRange(), */

            Column::make(__('ID USUARIO'), 'user_Nombre_usuario', 'users_Nombre_usuario')
            ->makeInputMultiSelect(User::all(), 'name', 'id')
            ->sortable(),

       /*      Column::make('ID INTERES', 'id_interes')
                ->makeInputRange(), */

            Column::make(__('ID INTERES'), 'interes_interes_prestamo', 'intereses_interes_prestamo')
            ->makeInputMultiSelect(Interes::all(), 'name', 'id')
            ->sortable(),

  /*           Column::make('ID MODO PAGO', 'id_modo_pago')
                ->makeInputRange(), */

            Column::make(__('ID MODO PAGO'), 'mod_pag_modalidad_pago', 'modo_pago_modalidad_pago')
            ->makeInputMultiSelect(ModoPago::all(), 'name', 'id')
            ->sortable(),

            Column::make('FECHA PRESTAMO', 'fecha_prestamo_formatted', 'fecha_prestamo')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

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
     * PowerGrid Prestamo Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('prestamo.edit', ['prestamo' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('prestamo.destroy', ['prestamo' => 'id'])
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
     * PowerGrid Prestamo Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($prestamo) => $prestamo->id === 1)
                ->hide(),
        ];
    }
    */
}
