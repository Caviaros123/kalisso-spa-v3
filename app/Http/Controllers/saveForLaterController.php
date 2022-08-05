<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use \App\Product;


class saveForLaterController extends Controller
{
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Le produit a bien été éffacer!');
    }

    /**
     *Switch item for shopping cart to move to cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart(Request $request, $id)
    {

        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search( function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {

            return redirect()->route('cart.index')->with('success_message', 'Ce produit existe dans votre panier!');
        }

        $images = $request->image;

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price,0,compact('images'))
            ->associate('App\product');

        return redirect()->route('cart.index')->with('success_message', 'Le produit a été deplacé dans votre panier!');

    }
}
