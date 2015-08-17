<?php 
class PostsController extends AppController {
	public $helpers = array('Html', 'Form');
	//'Html'と'Form'に関するヘルパーを呼び出しなさい！

	public function index() {
		$this->set('posts', $this->Post->find('all'));
		// 記事の一覧を引っ張ってきて、変数にセット$this->set('変数名', 中身);
		$this->set('title_for_layout', '記事一覧');
	}

	public function view($id = null)
	//idの初期値null
	 {
		$this->Post->id = $id; //Postのidに代入 //associationにより、Commentも紐付いている。
		$this->set('post', $this->Post->read()); //読み込んでViewにセット
	}

	public function add() { //add のアクションを加える！
		if ($this->request->is('post')) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Success!'); //「成功」と表示
				$this->redirect(array('action'=>'index')); // リダイレクト処理 redirect('/'); でもうまくいくが、配列でコントローラーアクションを展開することができる。(今回コントローラーは同じなので、アクションだけ指定してあげる)
			} else {
				$this->Session->setFlash('failed!'); //「失敗」と表示
			}
		}
	}

	public function edit($id = null) { //edit のアクションを加える！
		$this->Post->id = $id; //渡ってきたidを代入
		if ($this->request->is('get')) { //getした時に編集用のフォームにデータを突っ込む処理
			$this->request->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->request->data)) { // まずは保存を試みる
				$this->Session->setFlash('Success!!'); //うまく行ったらSuccess!
				$this->redirect(array('action' => 'index')); //リダイレクト
			} else {
				$this->Session->setFlash('Failed...'); // うまく行かなかったらFailed...
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) { //'get'でアクセスしてきたら、'例外'を返せ！！
			throw new MethodNotAllowedException(); //エラー
		}
		// if ($this->Post->delete($id)) {
		// 	$this->Session->setFlash('Deleted!!');
		// 	$this->redirect(array('action' => "index"));

		if ($this->request->is('ajax')) { //ajaxかどうか？
			if ($this->Post->delete($id)) { //データの削除を試みて、うまく行ったか行かなかったか
				$this->autoRender = false; //どっちも機能させない(勝手に書かせないため)
				$this->autoLayout = false;
				$response = array('id' => $id); //idをjson形式で返す
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect(array('action'=>'index')); //ajaxじゃない場合(例外処理)
	}
}