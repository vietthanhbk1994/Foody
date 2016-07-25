<?php

namespace App\Http\Controllers;

use Gate;
use App\User;

use App\Http\Requests;
use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Repositories\PageRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

define("URL_AFTER_GATE", "pages");

class PageController extends InfyOmBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepository = $pageRepo;
        
    }

    /**
     * Display a listing of the Page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pageRepository->pushCriteria(new RequestCriteria($request));
        $pages = $this->pageRepository->paginate(PAGINATE);
        //$pages->setPath();
        return view('pages.index')
            ->with('pages', $pages);
    }
    public function paginate()
    {
//        $this->pageRepository->pushCriteria(new RequestCriteria($request));
//        $pages = $this->pageRepository->paginate(10);
//
//        return view('pages.index')
//            ->with('pages', $pages);
    }
    /**
     * Show the form for creating a new Page.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        return view('pages.create');
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        
        $input = $request->all();

        $page = $this->pageRepository->create($input);

        Flash::success('Page saved successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * Display the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        return view('pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified Page.
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
        
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        return view('pages.edit')->with('page', $page);
    }

    /**
     * Update the specified Page in storage.
     *
     * @param  int              $id
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageRequest $request)
    {
        
        if (Gate::denies('admin')) {
            return redirect(url(URL_AFTER_GATE));
        }
        
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }
        //Kiem tra co trung ten voi old, ko trung ten voi #
        $this->validate($request,[
            'name' => 'unique:pages'. ($id ? ",name,$id" : '')
        ]);
        
        $page = $this->pageRepository->update($request->all(), $id);

        Flash::success('Page updated successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * Remove the specified Page from storage.
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
        
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        $this->pageRepository->delete($id);

        Flash::success('Page deleted successfully.');

        return redirect(route('pages.index'));
    }
}
