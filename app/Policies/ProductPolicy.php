<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

//change  __construct to my method

    public function update(User $user, Product $product)
    {
        return $user->id == $product->user_id;
    }
}
