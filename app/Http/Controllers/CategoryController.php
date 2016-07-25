<?php

namespace App\Http\Controllers;
use Gate;
use App\User;

use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Webpatser\Uuid\Uuid;

define("URL_AFTER_GATE", "categories");

class CategoryController extends InfyOmBaseController {

    /** @var  CategoryRepository */
    private $categoryRepository;
    private $urlAfterGate='categories';
    
    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $this->categoryRepository->pushCriteria(new RequestCriteria($request));
        $categories = $this->categoryRepository->paginate(PAGINATE);

        return view('categories.index')
                        ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create() {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request) {
        //$input = $request->all();
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $inputs['name'] = $request->name;

        $file = $request->file('image');

        $destination_path = 'uploads';
        $name_file = 'category-' . Uuid::generate(4) . '.' . $file->getClientOriginalExtension();
        $file->move($destination_path, $name_file);
        $inputs['image'] = $name_file;

        $category = $this->categoryRepository->create($inputs);

        Flash::success('Category saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request) {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        
        //Kiem tra co trung ten voi old, ko trung ten voi #
        $this->validate($request,[
            'name' => 'unique:categories'. ($id ? ",name,$id" : '')
        ]);
        
        $inputs['name'] = $request->name;
        
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
            $name_file = 'category-' . Uuid::generate(4) . '.' . $file->getClientOriginalExtension();
            $file->move($destination_path, $name_file);
            $inputs['image'] = $name_file;
        } else {
            //Ko xoa file cu.
            $inputs['image'] = $category->image;
        }
        $category = $this->categoryRepository->update($inputs, $id);
        Flash::success('Category updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }

        $category = $this->categoryRepository->findWithoutFail($id);
        
        
        
        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        //Delete Foods have category_id = id of category has $id
        $foods = \App\Models\Food::where('category_id',$id)->get();
        //unlink image of food
        foreach ($foods as $food) {
            unlink('uploads/' . $food->image);
        }
        \App\Models\Food::where('category_id',$id)->delete();
        
        unlink('uploads/' . $category->image);

        $this->categoryRepository->delete($id);
        
        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }

}
