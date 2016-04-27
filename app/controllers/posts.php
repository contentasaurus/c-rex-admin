<?php

	namespace App\Http\Controllers\Admin;

	use App\Models\Admin\Post;
	use App\Models\Admin\User;

	class PostsController extends BaseController {

		public function index() {
			$posts = Post::orderBy('published_at', 'DESC')->get();
			$total = Post::count();

			return \View::make('admin/pages/posts/list', compact('posts', 'total'));
		}

		public function create() {
			$data['users'] = $this->getUserList();

			return \View::make('admin/pages/posts/create', $data);
		}

		public function edit($id = null) {
			$data['post'] = Post::find($id);
			$data['users'] = $this->getUserList();

			return \View::make('admin/pages/posts/edit', $data);
		}

		public function store() {

			if (\Request::ajax()) {

				$post = new Post;

				if (count($_FILES)) {
					$files = $this->processImages($_POST, $_FILES);

					if (count($files['newfiles'])) {
						if (isset($files['postArray']['featuredImage'])) {
							$_POST['featuredImage'] = $files['postArray']['featuredImage'];
						}

					} else {
						unset($_FILES);
						foreach($files['unset'] as $objectKey) {
							if (isset($post->{$objectKey})) {
								$post->unset($objectKey);
							}
						}
					}
				} else {
					unset($_FILES);
				}

				unset($_POST['_token']);

				$keys = array_keys($_POST);

				foreach ($keys as $key) {
					$post->{$key} = is_array($_POST[$key]) && is_int(key($_POST[$key])) ? array_values($_POST[$key]) : $_POST[$key];
				}

				$post->permalink = 'perspective/'.strtolower(preg_replace(['/[^A-Za-z0-9\- ]/', '/[^A-Za-z0-9\-]/', '/-+/'], ['', '-', '-'], rtrim($_POST['title'])));
				$post->save();

				if (isset($_FILES)) {
					return \Response::json([
						'id' => $post['_id'],
						'permalink' => $post['permalink'],
						'type' => 'Post',
						'preview' => true,
						'files' => $files['newfiles']
					]);
				} else {
					return \Response::json([
						'id' => $post['_id'],
						'permalink' => $post['permalink'],
						'type' => 'Post',
						'preview' => true
					]);
				}

			} else {
				return \Redirect::route('admin.dashboard.index');
			}

		}

		public function update($id = null) {

			if (\Request::ajax()) {

				$post = Post::find($id);

				if (count($_FILES)) {
					$files = $this->processImages($_POST, $_FILES);

					if (count($files['newfiles'])) {
						if (isset($files['postArray']['featuredImage'])) {
							$_POST['featuredImage'] = $files['postArray']['featuredImage'];
						}

					} else {
						unset($_FILES);
						foreach($files['unset'] as $objectKey) {
							if (isset($post->{$objectKey})) {
								$post->unset($objectKey);
							}
						}
					}
				} else {
					unset($_FILES);
				}

				unset($_POST['_token']);
				unset($_POST['_method']);

				$keys = array_keys($_POST);

				foreach ($keys as $key) {
					$post->{$key} = is_array($_POST[$key]) && is_int(key($_POST[$key])) ? array_values($_POST[$key]) : $_POST[$key];
				}

				$post->permalink = 'perspective/'.strtolower(preg_replace(['/[^A-Za-z0-9\- ]/', '/[^A-Za-z0-9\-]/', '/-+/'], ['', '-', '-'], rtrim($_POST['title'])));
				$post->save();

				if (isset($_FILES)) {
					return \Response::json([
						'id' => $post['_id'],
						'permalink' => $post['permalink'],
						'type' => 'Post',
						'preview' => true,
						'files' => $files['newfiles']]);
					} else {
						return \Response::json([
							'id' => $post['_id'],
							'permalink' => $post['permalink'],
							'type' => 'Post',
							'preview' => true
						]);
					}

				} else {
					return \Redirect::route('admin.dashboard.index');
				}

			}

			public function destroy($id = null) {
				Post::destroy($id);
			}

		}
