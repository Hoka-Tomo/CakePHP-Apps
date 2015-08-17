<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController {

	//変数 $users $components $presetVars
	public $uses = array('Post','User','Entry');
    public $components = array('Search.Prg','Paginator');
    public $presetVars = true;



	//スレッド一覧
	public function index() { 
		$this->Post->recursive = 0;
		$this->Prg->commonProcess(); //共通コンポーネント
		$this->paginate = array (
			'conditions' => $this->Post->parseCriteria($this->passedArgs)
		);
		$this->set('posts', $this->Paginator->paginate());
		// スレッドの一覧を引っ張ってきて、変数にセット$this->set('変数名', 中身);
		//$this->set('title_for_layout', '掲示板');
		$this->set('users', $this->Auth->user());
		// ユーザーの一覧を引っ張ってきて、変数にセット$this->set('変数名', 中身);
	}


	//スレッド新規作成画面

	public function add() { //add のアクションを加える！
		if ($this->request->is('post')) {
			$id = $this->data['Post'];
			$id['user_id'] = $this->Auth->user('id');
			$this->Post->save($id);
			$this->Session->setFlash('スレッドを作成しました!!'); //うまく行ったことを表示
			$this->redirect(array('action' => 'index'));
			// リダイレクト処理 redirect('/'); でもうまくいくが、配列でコントローラーアクションを展開することができる。(今回コントローラーは同じなので、アクションだけ指定してあげる)
			} else {
				$this->render('add'); //レンダリング処理（データを元にして、表示、出力すること）
		}
	}


	//スレッド内の表示

	public function view($id = null) //idの初期値null
	{
		$post_data = $this->Post->findById($id); //post_dataに代入
		$this->set('post_data', $post_data); //変数にセット$this->set('変数名', 中身);

		$entry_data = $this->Entry->find('all', array(
			'conditions' => array(
				'Entry.post_id' => $id
			),
			'order' => array(
				'Entry.id' => 'asc'
				)
		));
		$this->set('entry_data', $entry_data);

		// スレッド閲覧数表示



		//$this->set('uses', $this->Auth->user());
		//$this->set(['Count']['id'] == ['Post']['id']);
		$uses = array('Posts','Count');
		$uses = $this->Post->findById($id);
		$this->set('uses', $uses); //変数にセット$this->set('変数名', 中身);

		// $uses = $this->Count->find ('all', array(
		// 	'conditions' => array(
		// 		'Count.id' => $id
		// 		),
		// $this->set('uses', $uses);
		// $this->Count->save($uses++);
	}

	//スレッド内にレスポンス作成

	public function res($id = null) {
		if ($this->request->is('post')) {
			$data = $this->data['Entry'];
			$data['user_id'] = $this->Auth->user('id');
			$data['post_id'] = $id;
			$this->Entry->save($data);
			$this->Session->setFlash('レスを書き込みました!!');
			$this->redirect(array('action' => 'view', $id));
			} else {
				$this->set('id', $id);
				$this->render('res');
		}
	}
}