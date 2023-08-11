<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    public static $clickAction = 'select';

    public static $perPageOptions = [10,20,50];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Slug::make('Slug')
            ->from('name')
            ->required()
            ->hideFromIndex()
            ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('name')
            ->required()
            ->sortable()
            ->placeholder('Product name....'),
            
            Markdown::make('Description')
            ->required(),

            Currency::make('Price')
            ->required()
            ->sortable()
            ->currency('BDT')
            ->textAlign('center')
            ->placeholder('Product Price....'),
            
            Text::make('Sku')
            ->required()
            ->placeholder('Product Sku....')
            ->textAlign('center')
            ->help('Number that retailers use to differentiate products and track inventory levels.'),

            Number::make('Quantity')
            ->required()
            ->placeholder('Enter Quantity....')
            ->textAlign('center'),

            BelongsTo::make('Brand')
            ->required(),

            Boolean::make('Status', 'is_published')
            ->required()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
