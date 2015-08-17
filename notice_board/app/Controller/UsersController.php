<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $uses = array('User', 'Post', 'Entry');
	public $helpers = array('Form');

	//ログイン前に実行可能なアクション
	public function beforeFilter() {
		Security::setHash('sha256');
		$this->Auth->allow('useradd', 'login', 'logout');
	}


	//ログイン機能
	public function login(){
        if($this->request->is('post')){
            if($this->Auth->login()){
                $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Session->setFlash('ユーザ名またはパスワードを確認して下さい');
            }
        }
    }




	//ログアウト機能
	public function logout() {
		$this->Auth->logout();
		$this->Session->destroy();
		$this->Session->setFlash('ログアウトしました');
		$this->redirect(array('action' => 'login'));
	}

	//ユーザー登録機能
	public function useradd() {
		if($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash('ユーザーを新規作成しました');
				$this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash('ユーザーを作成できませんでした');
			}
		}
	}

	public function view($id = null) {
		//ユーザー情報表示
		$this->set('users', $this->Auth->user());
		//$user = $this->User->findById($id); //対応するSQLは、User.id = $id
        //$this->set('user',$user);
        $posts_options = array(
            'conditions' => array(
                'Post.user_id' => $id
            )
        );

		//スレッド作成とレスポンスの履歴表示
		$this->set('posts', $this->Post->find('all', $posts_options));
		$this->set('posts_count', $this->Post->find('count', $posts_options));
		$entries_options = array(
			'conditions' => array(
				'Entry.user_id' => $id
			)
		);


		$this->set('entries', $this->Entry->find('all', $entries_options));
		$this->set('entries_count', $this->Entry->find('count', $entries_options));

	}

	

	public function administrator($id = null) {
		$this->set('users', $this->Auth->user());
		//$users = $this->User->findById($id); //対応するSQLは、User.id = $id
        //$this->set('users',$users);
        $posts_options = array(
            'conditions' => array(
                'Post.user_id' => $id
            )
        );
		//スレッド作成とレスポンスの履歴表示
		$this->set('posts', $this->Post->find('all', $posts_options));
		//find('all', $params) は配列で結果を返します。 find('all') は、他のいろいろなfind() や、 paginate でも使われています。
		$this->set('posts_count', $this->Post->find('count', $posts_options));
		//find('count', $params) は整数を返します。
		$entries_options = array(
			'conditions' => array(
				'Entry.user_id' => $id
			)
		);
		$this->set('entries', $this->Entry->find('all', $entries_options));
		$this->set('entries_count', $this->Entry->find('count', $entries_options));
	}





 	//編集（管理者限定）

	function edit($id = null) {

		$this->set('users', $this->Auth->user());
		$post_data = $this->Post->findById($id); //post_dataに代入
		$this->set('post_data', $post_data); //変数にセット$this->set('変数名', 中身);

    	if (!empty($this->data)) {
            // 編集時の処理
            $this->set('data',$this->data);
            if (!$this->User->checkNameAndPass($this->data)) {
                $this->User->invalidate('password','パスワードを確認ください。');
            } else {
                $this->Post->save($this->data);
                $this->redirect('.');
            }
        } else {
            $param = $this->Post->id;// ページにはじめてきたときの表示
            $res = $this->Post->read();
            $res['User']['password'] = null;
            $this->data = $res;
            $this->set('data',$res);
        }
    }
    // POST送信なら
    // if($this->request->is('post') || $this->request->is('put')) {
    //     $this->User->create();
    //     if ($this->User->save($this->request->data)) {
    //         //変更できたらusernameは更新する
    //         $user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
    //         $this->Session->write('Auth', $user);
    //         $this->set('users', $this->Auth->user());
    //         $this->Session->setFlash(__('変更しました'));
    //         $this->redirect(array('action' => 'index'));
    //     } else {
    //         $this->Session->setFlash(__('変更できませんでした。やり直して下さい'));
    //     }
    // }
 
    //指定プライマリーキーのデータをセット
    //$this->request->data = $user;

	// 	public function edit($id = null) { //edit のアクションを加える！
	// 		$this->Post->id = $id; //渡ってきたidを代入
	// 		if ($this->request->is('get')) { //getした時に編集用のフォームにデータを突っ込む処理
	// 			$this->request->data = $this->Post->read();
	// 		} else {
	// 			if ($this->Post->save($data)) { // まずは保存を試みる
	// 				$this->Session->setFlash('成功!!'); //うまく行ったらSuccess!
	// 				$this->redirect(array('action' => 'index')); //リダイレクト
	// 			} else {
	// 				$this->set('id', $id);
	// 				$this->render('edit');
	// 				$this->Session->setFlash('編集に失敗しました・・・'); // うまく行かなかったらFailed...
	// 			}
	// 		}
	// 	}
	// }


	//削除処理（管理者限定）
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