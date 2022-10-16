<?php

namespace App\JsonApi\V1\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\Boolean;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\HasOne;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class UserSchema extends Schema
{

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = User::class;

    /**
     * Get the resource fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            ID::make(),
            Str::make('email'),
            Str::make('password')->hidden(),
            Str::make('password_confirmation')->hidden(),
            DateTime::make('emailVerifiedAt')->sortable(),
            Str::make('ipAddr'),
            DateTime::make('dateSubmitted')->sortable(),
            Str::make('isVerified'),
            DateTime::make('dateVerified')->sortable(),
            Boolean::make('isVerified'),
            Number::make('maxdaysUnverified'),
            Boolean::make('isExpired'),
            DateTime::make('dateExpired')->sortable(),
            HasOne::make('registrant')->readOnly(),
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
