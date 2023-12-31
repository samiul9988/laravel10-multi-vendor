<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editButton     = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteButton   = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreButton     = '<div class="dropdown dropleft d-inline">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="'.route('admin.product-gallery.index', ['product'=>$query->id]).'"><i class="far fa-heart"></i> Image Gallery</a>
                        <a class="dropdown-item has-icon" href="'.route('admin.product-variant.index', ['product'=> $query->id]).'"><i class="far fa-file"></i> Variant</a>
                        <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                      </div>
                    </div>';

                return $editButton.$deleteButton.$moreButton;
            })
            ->addColumn('image', function ($query){
                return "<img width='100' src='".asset($query->thumb_image)."'></img>";
            })
            ->addColumn('type', function ($query){
                switch ($query->product_type){
                    case 'new_arrival' :
                        return "<i class='badge badge-success'>New Arrival</i>";
                        break;
                    case 'featured_product' :
                        return "<i class='badge badge-info'>Featured Product</i>";
                        break;

                    case 'top_product' :
                        return "<i class='badge badge-warning'>Top Product</i>";
                        break;
                    case 'best_product' :
                        return "<i class='badge badge-primary'>Best Product</i>";
                        break;

                    default :
                        return "<i class='badge badge-danger'>Non</i>";
                        break;
                }
            })
            ->rawColumns(['image','type','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('type'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
