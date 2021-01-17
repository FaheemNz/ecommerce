<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart as StoreCart;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected string $instance;

    public function __construct(string $instance = 'default')
    {
        $this->instance = $instance;
    }

    public function itemAlreadyExists($id, $useRowIdCheck = false)
    {
        return StoreCart::instance($this->instance)
            ->search(fn ($item, $rowId) => ($useRowIdCheck ? $rowId : $item->id) === $id)
            ->isNotEmpty();
    }

    public function add($model)
    {
        StoreCart::instance($this->instance)
            ->add(
                $model->id,
                $model->name,
                1,
                $model->price,
                ['slug' => $model->slug, 'details' => $model->details, 'image' => $model->image, 'totalQty' => $model->quantity]
            )
            ->associate('App\Models\Product');
    }

    public function remove(string $rowId)
    {
        StoreCart::instance($this->instance)->remove($rowId);
    }

    public function updateCart(string $rowId, int $quantity)
    {
        return StoreCart::instance($this->instance)->update($rowId, $quantity);
    }

    public function saveForLater($id)
    {
        $item = StoreCart::instance('default')->get($id);
        StoreCart::instance('default')->remove($id);

        if ($this->itemAlreadyExists($id, true)) {
            return false;
        }

        return StoreCart::instance('saveForLater')->add($item);
    }

    public function moveBackToCart(string $id)
    {
        $item = StoreCart::instance('saveForLater')->get($id);
        StoreCart::instance('saveForLater')->remove($id);
        StoreCart::instance($this->instance)
            ->add(
                $item->id,
                $item->name,
                1,
                $item->price,
                ['slug' => $item->options['slug'], 'details' => $item->options['details'], 'image' => $item->options['image']]
            );
    }
}
