<?php

namespace App\JsonApi\V1\Registrants;

use App\Models\Registrant;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class RegistrantSchema extends Schema
{

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = Registrant::class;

    /**
     * Get the resource fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            ID::make(),
            Str::make('regFirstname'),
            Str::make('regMiddlename'),
            Str::make('regLastname'),
            Str::make('regBirthdate'),
            Str::make('regCivilstatus'),
            Str::make('regReligion'),
            Str::make('regAddrLine1'),
            Str::make('regAddrLine2'),
            Str::make('regAddrTowncity'),
            Str::make('regAddrState'),
            Number::make('regCountryCode'),
            Str::make('regProAddrLine1'),
            Str::make('regProAddrLine2'),
            Str::make('regProAddrTowncity'),
            Str::make('regProAddrState'),
            Str::make('regProAddrCountry'),
            DateTime::make('regDatecreated')->sortable(),
            DateTime::make('regDatemodified')->sortable(),
            BelongsTo::make('user')->readOnly(),
        ];
    }

    /**
     * Get the resource filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
        ];
    }

    /**
     * Get the resource paginator.
     *
     * @return Paginator|null
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }

}
