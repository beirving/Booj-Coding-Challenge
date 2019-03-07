<?php
/**
 * Created by PhpStorm.
 * User: bradleyirving
 * Date: 2019-03-05
 * Time: 15:01
 */

namespace App;

use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Book extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'book';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'publication_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function addSorting(Request $request) :array
    {
        $sort = $request->get('sort');

        //check if there is a direction
        if (strpos($sort, '.')!== false){
            $explode = explode('.', $sort, 2);
            $direction = strtoupper($explode[1]);
            $sort = $explode[0];
        } else{
            //default to descending
            $direction ='DESC';
        }//end if

        return ['sort' =>$sort, 'dir'=>$direction];
    }
}
