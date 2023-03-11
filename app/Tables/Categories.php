<?php

namespace App\Tables;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Categories extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Category::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->column( 'id', canBeHidden: false,sortable: true,searchable: true,label:__('id'))
        ->column('name', canBeHidden: false,sortable: true,searchable: true,label:__('title'))
        ->column('slug',sortable: true,searchable: true,label:__('slug'))
        ->column('updated_at',sortable:true,label:__('updated_at'))
        ->withGlobalSearch(columns: ['name', 'slug'])
        ->column('action', exportAs: false,label:__('actions'))
        ->bulkAction(
            label:__('touch_time'),
            each: fn (Category $category) => $category->touch(),
            before: fn () => info('Touching the selected projects'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label:  __('delete_category') ,
            each: fn (Category $category) => $category->delete(),
            // before: fn () => info('Touching the selected projects'),
            after: fn () => Toast::title('Categories Deleted Successfully!')
            ->warning()
            ->autoDismiss(3)
        )
        ->export()
        ->paginate(15);
        // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
