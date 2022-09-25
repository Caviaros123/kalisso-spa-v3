<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category;
use App\Profile;


class TaskController extends Controller
{
    public function exportCsv(Request $request)
    {
       $fileName = 'membres_kalisso.csv';
       $tasks = User::all();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('name', 'lastname', 'phone', 'isSeller', 'email', 'created_at');

            $callback = function() use($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['name']  = $task->name;
                    $row['lastname']    = $task->lastname;
                    $row['phone']    = $task->phone;
                    $row['isSeller']  = $task->isSeller;
                    $row['email']  = $task->email;
                    $row['created_at']  = $task->created_at;

                    fputcsv($file, array($row['name'], $row['lastname'], $row['phone'], $row['isSeller'], $row['email'], $row['created_at']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
    }

    public function exportCsvProducts(Request $request)
    {
       $fileName = 'produits_kalisso.csv';
       $tasks = Product::all();
       $getCat = Category::all();
        $path = storage_path('/'.$fileName);

       

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('id', 'title','description','availability','condition','price','link','image_link','brand', 'google_product_category','fb_product_category','inventory');

            $callback = function() use($tasks, $columns) {
                $file = fopen("produits_kalisso.csv", "w");
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                        
                        $catFetch = json_decode($task->category);
                        $getCategory = Category::whereJsonContains('id', $catFetch)->get();
                       

                        $row['id']  = $task->id;
                        $row['title']   =  strtolower($task->name);
                        $row['description']    = $task->name.' '.$task->details.' '.$task->description.'Vendu par kalisso.com';
                        $row['availability']  = $task->stock >= 1 ? 'in stock' : 'out of stock';
                        $row['condition']  = $task->etat == 'radio1' ? 'new' : 'new';
                        $row['price']  =  str_replace(',', '.', number_format($task->price, 0));
                        $row['link']  = 'https://www.kalisso.com/show/'.$task->slug;
                        $row['image_link']  = 'https://www.kalisso.com/storage/'.$task->image;
                        $row['brand']  = 'Vendu par kalisso.com';
                        $row['google_product_category']  = '313';
                        $row['fb_product_category']  = '313';
                        $row['inventory']  = $task->stock;
           
                        

                        fputcsv($file, array(
                            $row['id'],
                            $row['title'],
                            $row['description'],
                            $row['availability'],
                            $row['condition'],
                            $row['price'],
                            $row['link'],
                            $row['image_link'],
                            $row['brand'],
                            $row['google_product_category'],
                            $row['fb_product_category'],
                            $row['inventory'] ,


                        ));
                    
                 
                }

                fclose($file);

                
            };

            return response()->stream($callback, 200, $headers)->send();
    }
}
