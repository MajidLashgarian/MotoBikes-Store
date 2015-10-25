<?php
/**
 * Created by PhpStorm.
 * User: Majid Lashgarian
 * Date: 10/23/15 AD
 * Time: 15:45
 */

namespace App\Http\Controllers\Bikes;

use App\Http\Controllers\Controller;
use App\Motobike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class Bikes extends Controller {

    /**
     * The validator list for register new bike form
     *
     * @var array
     */
    private $bikeValidatorForm =  [
                                    'vendor_name' => 'required|max:50', //required and max 100 character
                                    'model' => 'required|max:50',//required and max 100 character
                                    'produce_year' => 'required',//required
                                    'size_of_motor' => 'required|integer|min:0',//required , must be integer and greter than 0
                                    'color' => 'required',//required
                                    'weight' => 'required|integer|min:0',//required , must be integer and greter than 0
                                    'price' => 'required|integer|min:0',//required , must be integer and greter than 0
                                    'image' => 'required|max:102400'//required , must be jpg,bmp or png and image file size must be less than 100MB
                                  ];



    /**
     * If request is a GET then Call blade template engine to render register new motobike page
     * If request is a POST then add data into a bike table
     * Http POST/GET method
     *
     * @param Request $requst Http
     * @return Register new bike page rendered view
     */
    public function registerNewBike(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('bikes.register_newbike' ,  ['isAdmin'=>Auth::check()]);
        }
        else{ //it sent from form in register_newbike view
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(),$this->bikeValidatorForm);

                //validate register form for admin user
                if ($validator->fails()) {
                    return redirect('admin/register_newbike')
                                                             ->withErrors($validator)
                                                             ->withInput();
                }else{
                    return view('bikes.register_success' , ['motobike'=> $this->createMotoBike($request) ,
                                                            'isAdmin'=>Auth::check()]);
                }

            }
        }
        App::abort(404);

    }//end of function



    /**
     * Move image file from temprory folder to upload folder and Create new Bike model instance
     *
     * @param Request $request list of all data which sent from register form
     * @return instance of moto bike model
     */
    private function createMotoBike(Request $request)
    {
        $request->file('image')
                ->move(public_path()."/upload/" , $request->file('image')->getFilename()) ;

        $image_src = "/upload/".$request->file('image')->getFilename();
        return Motobike::create(['model_name'=>$request->get('model')        ,
                                'model_date'=>$request->get('produce_year') ,
                                'vendor'=>$request->get("vendor_name")      ,
                                'color'=>$request->get('color')             ,
                                'cc'=>$request->get("size_of_motor")        ,
                                'weight'=>$request->get("weight")           ,
                                'price'=>$request->get("price")             ,
                                'img_src'=>$image_src ]);
    }


    /**
     * Show All motobikes which regestered in database with help of pagination
     *
     * @param Request $request Http get request to getting sorting attribute from url
     * @return render view template of show_allbike.blade.php
     */
    public function showAllMotoBike(Request $request){
        //set default variable
        $type = 'created_at';
        $sort = 'ASC';

        //check for data existance in URL(GET HTTP)
        if($request->has("type") && $request->has("sort")){
            $type = $request->input("type");
            $sort = $request->input("sort");

            //check for validity
            if(($sort != "ASC" && $sort != "DESC") )
            {
                $sort = 'created_at';
            }
            if($type != "price" && $type != "created_at" && $type != "wieght")
            {
                $type = 'ASC';
            }
        }

        //select and paginate
        $products = Motobike::orderBy($type , $sort)
            ->paginate(5);

        return view('bikes.show_allbike' , ['products'=>$products ,  'isAdmin'=>Auth::check()]);
    }

    /**
     * Show Selected motobikes with ID  in database with
     *
     * @return render view template of Show_motobike.blade.php
     */
    public function ShowMotoBike($id){
        //get ID from URL (GET HTTP Request) and select motobike with that ID
        $motobike = Motobike::where('id',$id);

        if($motobike->count() > 0)
        {
            return view('bikes.show_motobike' , ['motobike'=>$motobike->first() , 'isAdmin'=>Auth::check()]);
        }
        else{
            App::abort(404);
        }
    }

    /**
     * Search motobike from database and get all of data
     *
     * @return rendered view for showall moto bike view with result data
     */
    public function searchBike(Request $request){

            if($request->has("query")){
                $query = $request->input("query");

                //convert regular expersion to SQL wild card
                $query = str_replace('*' , '%' , $query);
                $query = str_replace('^' , '_' , $query);

                //default for sorting
                $type = 'created_at';
                $sort = 'ASC';

                //check for existance of data and check for validation
                if($request->has("type") && $request->has("sort")){
                    $type = $request->input("type");
                    $sort = $request->input("sort");
                    if(($sort != "ASC" && $sort != "DESC")){
                        $sort = 'created_at';
                    }
                    if($type != "price" && $type != "created_at" &&  $type != "wieght") {
                        $type = 'ASC';
                    }
                }

                //select data from data base
                $result = Motobike::where('vendor' , 'like' , $query)
                        ->orWhere('model_name' , 'like' , $query)
                        ->orderBy($type , $sort)
                        ->paginate(5);

                //show search result
                return view('bikes.search_result' , ['products'=>$result ,  'isAdmin'=>Auth::check()]);


            }else if($request->has("color")) //filtering with color
            {
                //get filtered color
                $query = $request->input("color");

                //select from data base
                $result = Motobike::where('color' , $query)
                    ->paginate(5);

                //show in search result page
                return view('bikes.search_result' , ['products'=>$result ,  'isAdmin'=>Auth::check()]);
            }
        App::abort(404);
    }


}