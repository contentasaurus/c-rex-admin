<?php

  namespace App\Http\Controllers\Admin;

  use App\Models\Admin\Page;

  class PagesController extends BaseController {

  	public function index() {
  		$pages = Page::where('type', '=', 'page')->get();
  		$total = Page::where('type', '=', 'page')->count();

  		return \View::make('admin/pages/pages/list', compact('pages', 'total'));
  	}

  	public function create() {
  		$pages = Page::where('type', '=', 'page')->get(['title', 'permalink']);

  		$data['parents'] = ['' => 'Select a Parent Page'];

  		foreach($pages as $page) {
  			$data['parents'][$page->permalink] = $page->title;
  		}

      $data['users'] = $this->getUserList();

  		return \View::make('admin/pages/pages/create', $data);
  	}

    public function edit($id = null) {
  		$pages = Page::where('type', '=', 'page')->get(['title', 'permalink']);

  		$data['parents'] = ['' => 'Select a Parent Page'];

  		foreach($pages as $page) {
  			$data['parents'][$page->permalink] = $page->title;
  		}

  		$data['page'] = Page::find($id);
      $data['users'] = $this->getUserList();

  		return \View::make('admin/pages/pages/edit', $data);
  	}

  	public function store() {
  		if (\Request::ajax()) {

  			unset($_POST['_token']);

        	$permalink = strtolower(preg_replace(['/[^A-Za-z0-9\- ]/', '/[^A-Za-z0-9\-]/', '/-+/'], ['', '-', '-'], rtrim($_POST['title'])));

        	if (!empty($_POST['parent_page'])) {
				$permalink = $_POST['parent_page'].'/'.$permalink;
			} else {
				unset($_POST['parent_page']);
			}

  			$keys = array_keys($_POST);

  			$page = new Page;

	        foreach ($keys as $key) {
	          $page->{$key} = is_array($_POST[$key]) && is_int(key($_POST[$key])) ? array_values($_POST[$key]) : $_POST[$key];
	        }

  			$page->permalink = $permalink;
  			$page->save();

  			return \Response::json([
	          'id' => $page['_id'],
	          'permalink' => $page['permalink'],
	          'type' => 'Page',
	          'preview' => true
	        ]);
  		} else {
  			return \Redirect::route('admin.dashboard.index');
  		}
  	}

  	public function update($id = null) {

  		if (\Request::ajax()) {

  			unset($_POST['_token']);
  			unset($_POST['_method']);

        	$permalink = strtolower(preg_replace(['/[^A-Za-z0-9\- ]/', '/[^A-Za-z0-9\-]/', '/-+/'], ['', '-', '-'], rtrim($_POST['title'])));

        	if (!empty($_POST['parent_page'])) {
				$permalink = $_POST['parent_page'].'/'.$permalink;
			} else {
				unset($_POST['parent_page']);
			}

  			$keys = array_keys($_POST);

  			$page = Page::find($id);

	        foreach ($keys as $key) {
	          $page->{$key} = is_array($_POST[$key]) && is_int(key($_POST[$key])) ? array_values($_POST[$key]) : $_POST[$key];
	        }

	        $page->permalink = $permalink;
			$page->save();

	        return \Response::json([
	          'id' => $page['_id'],
	          'permalink' => $page['permalink'],
	          'type' => 'Page',
	          'preview' => true
	        ]);

  		} else {
  			return \Redirect::route('admin.dashboard.index');
  		}

  	}

  	public function destroy($id = null) {
  		Page::destroy($id);
  	}

  }
