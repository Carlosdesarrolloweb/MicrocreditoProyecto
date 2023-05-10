<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Illuminate\Mail\Markdown;


final class clientesTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Cliente>
    */
    public function datasource(): Builder
    {
        return Cliente::query();
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
            ->addColumn('Carnet_cliente')

           /** Example of custom column using a closure **/
            ->addColumn('Carnet_cliente_lower', function (Cliente $model) {
                return strtolower(e($model->Carnet_cliente));
            })

            ->addColumn('nombre_cliente')
            ->addColumn('apellido_cliente')
            ->addColumn('direccion_cliente')
            ->addColumn('email_cliente')
            ->addColumn('telefono_cliente')
            ->addColumn('edad_cliente')
            ->addColumn('telefono_referencia')
            ->addColumn('estado_cliente')
            ->addColumn('nombre_zona', function (Cliente $model) {
                return $model->zona->nombre_zona;
            })
            ->addColumn('imagen_cliente', function (Cliente $model) {
                return '<img src="'.$model->fotocarnet->direccion_imagen.'" width="75px" height="75px">';
            });

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
            // Column::make('ID', 'id')
            //     ->makeInputRange(),

            Column::make('CARNET CLIENTE', 'Carnet_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('NOMBRE CLIENTE', 'nombre_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('APELLIDO CLIENTE', 'apellido_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('DIRECCION CLIENTE', 'direccion_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

     /*        Column::make('EMAIL CLIENTE', 'email_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(), */

            Column::make('TELEFONO CLIENTE', 'telefono_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EDAD CLIENTE', 'edad_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

      /*       Column::make('TELEFONO REFERENCIA', 'telefono_referencia')
                ->sortable()
                ->searchable()
                ->makeInputText(), */

            Column::make('ESTADO CLIENTE', 'estado_cliente')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('NOMBRE ZONA', 'nombre_zona')
                ->makeInputRange(),

            Column::make('IMAGEN CLIENTE', 'fotocarnet')
          /*    ->asHtml()
             ->centered(), */

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Cliente Action Buttons.
     *
     * @return array<int, Button>
     */


/*     public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('clientes.editarclientes', ['cliente' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('cliente.destroy', ['cliente' => 'id'])
               ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Cliente Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($cliente) => $cliente->id === 1)
                ->hide(),
        ];
    }
    */
}
