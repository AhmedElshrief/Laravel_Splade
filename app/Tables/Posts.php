<?php

namespace App\Tables;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Posts extends AbstractTable
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
        return Post::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $categories = Category::all();

        $table
            ->column('id', canBeHidden: false,sortable: true,searchable: true,label:__('id'))
            ->column('title', canBeHidden: false,sortable: true,searchable: true,label:__('title'))
            ->column('slug',sortable: true,searchable: true,label:__('slug'))
            ->column('category_id',sortable: true,searchable: true,label:__('cat_id'))
            ->column('date',sortable: true,searchable: true,label:__('date'))
            // ->column('descr',sortable: true,searchable: true,label:__('descr'))
            // ->column('description',sortable: true,searchable: true,label:__('description'))
            ->column('category.name',sortable: true,searchable: true,label:__('category'))

            // ->selectFilter('category_id',$categories )
            ->withGlobalSearch(columns: ['title', 'slug'])
            ->column('action', exportAs: false,label:__('actions'))
            // ->bulkAction(
            //     label: 'Touch timestamp',
            //     each: fn (Post $post) => $post->touch(),
            //     before: fn () => info('Touching the selected projects'),
            //     after: fn () => Toast::info('Timestamps updated!')
            // )
            ->bulkAction(
                label: 'Delete Post',
                each: fn (Post $post) => $post->delete(),
                // before: fn () => info('Touching the selected projects'),
                after: fn () => Toast::title('Posts Deleted Successfully!')
                ->warning()
                ->autoDismiss(3)
            )
            ->export(label: 'Posts To Excel')
                ->paginate(15);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
