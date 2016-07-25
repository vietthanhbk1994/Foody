<?php

namespace App\Http\Controllers;
use Gate;
use App\User;

use App\Http\Requests;
use App\Http\Requests\CreateFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Repositories\FoodRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Webpatser\Uuid\Uuid;

define("URL_AFTER_GATE", "foods");

class FoodController extends InfyOmBaseController
{
    /** @var  FoodRepository */
    private $foodRepository;
    private $urlAfterGate='foods';

    public function __construct(FoodRepository $foodRepo)
    {
        $this->foodRepository = $foodRepo;
        
    }
    
    /**
     * Display a listing of the Food.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->foodRepository->pushCriteria(new RequestCriteria($request));
        $foods = $this->foodRepository->paginate(PAGINATE);
        $categories = \App\Models\Category::all(['id','name']);
        foreach ($categories as $key)
        {
            $category_ids[$key->id] = $key->name;
        }
        
        return view('foods.index')
            ->with('foods', $foods)->with('category_ids',$category_ids);
    }

    /**
     * Show the form for creating a new Food.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        
        $categories = \App\Models\Category::all(['id','name']);
        foreach ($categories as $key)
        {
            $category_ids[$key->id] = $key->name;
        }
        return view('foods.create')->with('category_ids',$category_ids);
    }

    /**
     * Store a newly created Food in storage.
     *
     * @param CreateFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodRequest $request)
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $input = $request->all();
        
        $file = $request->file('image');
        
        $destination_path = 'uploads';
        $name_file = 'food-' . Uuid::generate(4) . '.' . $file->getClientOriginalExtension();
        $file->move($destination_path, $name_file);
        $input['image'] = $name_file;
        
        $food = $this->foodRepository->create($input);

        Flash::success('Food saved successfully.');

        return redirect(route('foods.index'));
    }

    /**
     * Display the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }

        return view('foods.show')->with('food', $food);
    }

    /**
     * Show the form for editing the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }
        
        $categories = \App\Models\Category::all(['id','name']);
        foreach ($categories as $key)
        {
            $category_ids[$key->id] = $key->name;
        }
        return view('foods.edit')->with('food', $food)->with('category_ids',$category_ids);
    }

    /**
     * Update the specified Food in storage.
     *
     * @param  int              $id
     * @param UpdateFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodRequest $request)
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }
        
        //Kiem tra co trung ten voi old, ko trung ten voi #
        $this->validate($request,[
            'name' => 'unique:foods'. ($id ? ",name,$id" : '')
        ]);
        
        $inputs = $request->all();
        $file = $request->file('image');
        // Co chon file khac
        if ($file) {
            //Xoa file cu. Luu file moi
            if($file->getClientOriginalName()=='no-image.jpg'){
                //ko unlink
            }else{
                unlink('uploads/' . $category->image);
            }
            $destination_path = 'uploads';
            $name_file = 'food-' . Uuid::generate(4) . '.' . $file->getClientOriginalExtension();
            $file->move($destination_path, $name_file);
            $inputs['image'] = $name_file;
        } else {
            //Ko xoa file cu.
            $inputs['image'] = $food->image;
        }

        $food = $this->foodRepository->update($inputs, $id);

        Flash::success('Food updated successfully.');

        return redirect(route('foods.index'));
    }

    /**
     * Remove the specified Food from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('foods.index'));
        }

        $this->foodRepository->delete($id);
        
        unlink('uploads/' . $food->image);
        
        Flash::success('Food deleted successfully.');

        return redirect(route('foods.index'));
    }
}
