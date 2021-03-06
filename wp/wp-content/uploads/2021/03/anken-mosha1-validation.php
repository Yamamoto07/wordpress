<?php
	function validation($data) {
		$errors = [];	
		
		//名前
		if(empty($data['name']) || 20 < mb_strlen($data['name'])) {
			$errors[] = '名前は20字以内で入力してください。';
		}
		//未入力、かつ、20字以上の場合はエラー表示
		
		//ふりがな
		if(empty($data['furigana']) || 20 < mb_strlen($data['furigana'])) {
			$errors[] = 'ふりがなは20字以内で入力してください';
		}
		//未入力、かつ、20字以上の場合はエラー表示
		
		//メール表示
		if(empty($data['email']) || !filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'メールアドレスを正しい形式で入力してください。';
		}
		//未入力、かつ、filter_varのメール形式に引っかかったらエラー表示
		
		//電話番号
		if(empty($data['tel']) || !filter_var($data['tel'],FILTER_SANITIZE_NUMBER_INT)) {
			$errors[] = '電話番号を正しい形式で入力してください。';
		}
		//未入力、かつ、filter_varの電話形式にひっかかったらエラー表示
			
		//お問い合わせ項目
		if(empty($data['item'])) {
			$errors[] = 'お問い合わせ項目を選択してください。';
		}
		//issetで選択チェック
		
		//お問い合わせ内容
		if(empty($data['content']) || 200 < mb_strlen($data['content'])) {
			$errors[] = 'お問い合わせ内容は200字以内で入力してください。';
		}
		//未入力かつ、200文字以上の場合はエラー表示
				
		return $errors;
	}
?>