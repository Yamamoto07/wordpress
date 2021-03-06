<?php
	session_start();
	//csrf対策セッションを使用するという宣言

	require 'anken-mosha1-validation.php';

	header('X-FRAME-OPTIONS: DENY');
	//clickjacking対策

	function h($str) {
		return htmlspecialchars($str, ENT_QUOTES,'UTF-8');
	}
	//xss対策

	//echo '<pre>';
	//var_dump($_POST);
	//echo '<pre>';
	//echo $_GET['name'];

	$pageFlag = 0;
	//1ページで入力→確認→完了まで表示する場合
	//pageFlagという変数を使って遷移させる
	
	$errors = validation($_POST);
	//バリデーションのエラー表示を受け取る変数

	if(!empty($_POST['btn_confirm']) && empty($errors)) {
		$pageFlag = 1;
	}
	//確認ボタンが空じゃないかつ、エラーメッセージが空だったらページを変える
	
	if(!empty($_POST['btn_submit'])) {
		$pageFlag = 2;
	}

	error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="anken-mosha1-form.css">
<link rel="stylesheet" href="anken-mosha1-responsive.css">
<script src="https://kit.fontawesome.com/c000d8f8d0.js" crossorigin="anonymous"></script>
</head>

<body>

	<?php if($pageFlag === 0) : ?>
	<!-- 入力画面 -->

	<?php
		if(!isset($_SESSION['csrfToken'])) {
			$csrfToken = bin2hex(random_bytes(32));
			$_SESSION['csrfToken'] = $csrfToken;
		}
		$token = $_SESSION['csrfToken'];
	?>
	<!-- csrf対策 合言葉の設定 -->
	
	<form action="" method="POST">
		<div class="form">

            <!--<div class="header">-->
			<div class="header-image">
				<div class="header-wrapper">
                    <a href="anken-mosha1.html" class="header-logo">
                        TECHMEETS<br>
                        ダミーテキスト
                    </a>
                    <a href="#" class="header-icon" id="show">
                        <i class="fas fa-bars" ></i>
                    </a>

                    <div class="header-btn">
                        <a href="#" class="header-btn1">無料相談</a>
                        <a href="anken-mosha1-form.php" class="header-btn2">お問い合わせ</a>    
                    </div>
                    
                    <div class="header-list">
                        <ul>
                            <li>TOP</li>
                            <li>カリキュラム</li>
                            <li>料金</li>
                            <li>アクセス</li>
                        </ul>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
			<!--</div>-->
		<div id="cover"></div>
		
		<div id="menu">
			<i class="fa fa-times" id="hide"></i>
			<ul>
				<li>TOP</li>
				<li>カリキュラム</li>
				<li>料金</li>
				<li>アクセル</li>
				<li>無料相談</li>
				<li><a href="anken-mosha1-form.php" class="menu-btn">お問い合わせ</a></li>
			</ul>
		</div>
        

	<!-- menu -->
	
	<script type="text/javascript">
	(function() {
		'use strict';
		
		var show = document.getElementById('show');
		var hide = document.getElementById('hide');
		
		show.addEventListener('click', function() {
			document.body.className ='menu-open';
		});
		
		hide.addEventListener('click', function() {
			document.body.className = '';
		});
	})();
	</script>	
		
		<div class='form-group'>
			<div class='form-group-wrapper'>
		<h1 class="contact-title">お問い合わせ　内容入力</h1>
		<p>お問い合わせ内容をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
			
		<?php if(!empty($_POST['btn_confirm']) && !empty($errors)) :?>
	<!-- 確認ボタンが空ではなく、かつエラーが空ではなかったら -->
	<ul>
		<?php foreach ($errors as $value) :?>
		<!-- $errorsは連想配列なのでforeachで分解していく -->
		<li class="form-error-list"><?php echo $value ;?></li>
		<!-- 分解したエラー分をlistの中に表示していく -->
		<?php endforeach ;?>
	</ul>
	<?php endif ;?>
		<div class="form-input">
			<div class="form-input-item">
				<label>お名前<span>(必須)</span></label>
				<input type="text" name="name" placeholder="例) 山田太郎" value="<?php echo h($_POST['name']) ; ?>">
			</div>
			<div class="form-input-item">
				<label>ふりがな<span>(必須)</span></label>
				<input type="text" name="furigana" placeholder="例) やまだたろう" value="<?php echo h($_POST['furigana']) ; ?>">
			</div>
			<div class="form-input-item">
				<label>メールアドレス<span>(必須)</span></label>
				<input type="text" name="email" placeholder="例) guest@example.com" value="<?php echo h($_POST['email']) ; ?>">
			</div>
			<div class="form-input-item">
				<label>電話番号<span>(必須)</span></label>
				<input type="text" name="tel" placeholder="例) 0000000000" value="<?php echo h($_POST['tel']) ; ?>">
			</div>
			<div class="form-input-item">
				<label>性別<span>(必須)</span></label>
				<label for="gender-male">
					<input id="gender-male" type="radio" name="gender" value="男性" 
					<?php if((!empty($_POST['gender']) && $_POST['gender'] === "男性") || empty($_POST['gender'])){ echo 'checked'; }
					?>>男性
				</label>
				<label for="gender-female">
					<input id="gender-female" type="radio" name="gender" value="女性" <?php if(!empty($_POST['gender']) && $_POST['gender'] === "女性"){ echo 'checked'; } ?>>女性
				</label>
			</div>
			<div class="form-input-item">
				<label>お問い合わせ項目<span>(必須)</span></label>
				<select name="item">
					<option value="">お問い合わせ項目を選択してください</option>
					<option value="ご質問・お問い合わせ" <?php if(!empty($_POST['item']) && $_POST['item'] === "ご質問・お問い合わせ"){ echo 'selected'; } ?>>ご質問・お問い合わせ</option>
					<option value="ご意見・ご感想" <?php if(!empty($_POST['item']) && $_POST['item'] ==="ご意見・ご感想"){ echo 'selected'; } ?>>ご意見・ご感想</option>
				</select>
			</div>
			<div class="form-input-item">
				<label>お問い合わせ内容<span>(必須)</span></label>
				<textarea name="content" rows="5" placeholder="お問い合わせ内容を入力"><?php if(!empty($_POST["content"])){ echo h($_POST["content"]); } ?></textarea>
			</div>
			    <div class="clear"></div>
			</div>
			<br>
			<input type="submit" name="btn_confirm" value="確認画面へ" class="btn-primary">
			<input type="hidden" name="csrf" value="<?php echo $token; ?>">
		</div>
			</div>
		</div>
		
		<div class="footer">
            <div class="footer-wrapper">
                <a href="anken-mosha1.html" class="footer-logo">
                    TECHMEETS<br>
                    ダミーテキスト
                </a>
                
                <div class="responsive-footer-logo">
                    <p>＠TECHMEETS DUMMY TEXT</p>
                </div>
                
                <div class="responsive-footer-text">
                    <p>All Right Reserved.</p>
                </div>
                
                <div class="footer-list">
                    <ul>
                        <li>TOP</li>
                        <li>カリキュラム</li>
                        <li>料金</li>
                        <li>アクセス</li>
                        <li>無料相談</li>
                        <li>お申込み</li>
                        <li>プライバシーポリシー</li>
                    </ul>
                </div>    
            </div>
        </div>
	</form>
	<?php endif ;?>
	
	<?php if($pageFlag === 1) : ?>
	<!-- 確認画面 -->
	
	<?php if($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
	<!-- csrf対策 入力できたcsrfと$_SESSIONの情報があっているかを確認する -->
		<form method="POST" action="" class="form-group">
            <!--<div class="header">-->
				<div class="header-image">
                <div class="header-wrapper">
                    <a href="anken-mosha1.html"class="header-logo">
                        TECHMEETS<br>
                        ダミーテキスト
                    </a>
                    <a href="#" class="header-icon" id="show">
                        <i class="fas fa-bars" ></i>
                    </a>

                    <div class="header-btn">
                        <a href="#" class="header-btn1">無料相談</a>
                        <a href="anken-mosha1-form.php" class="header-btn2">お問い合わせ</a>    
                    </div>
                    
                    <div class="header-list">
                        <ul>
                            <li>TOP</li>
                            <li>カリキュラム</li>
                            <li>料金</li>
                            <li>アクセス</li>
                        </ul>
                    </div>

                </div>
                <div class="clear"></div>
				<!--</div>-->
            </div>
			
		<div id="cover"></div>
		
		<div id="menu">
			<i class="fa fa-times" id="hide"></i>
			<ul>
				<li>TOP</li>
				<li>カリキュラム</li>
				<li>料金</li>
				<li>アクセル</li>
				<li>無料相談</li>
				<li>お問い合わせ</li>
			</ul>
		</div>
        

	<!-- menu -->
	
	<script type="text/javascript">
	(function() {
		'use strict';
		
		var show = document.getElementById('show');
		var hide = document.getElementById('hide');
		
		show.addEventListener('click', function() {
			document.body.className ='menu-open';
		});
		
		hide.addEventListener('click', function() {
			document.body.className = '';
		});
	})();
	</script>
			
			<div class="form-group">
				<div class="form-group-wrapper">
			<h1 class="contact-title">お問い合わせ 内容確認</h1>
			<p>お問い合わせ内容はこちらでよろしいでしょうか？<br>
				よろしければ「送信する」ボタンを押してください。</p>
	
			<div class="form-input">
				<div class="form-input-item">
					<label>お名前</label>
					<p><?php echo h($_POST['name']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>ふりがな</label>
					<p><?php echo h($_POST['furigana']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>メールアドレス</label>
					<p><?php echo h($_POST['email']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>電話番号</label>
					<p><?php echo h($_POST['tel']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>性別</label>
					<p><?php echo h($_POST['gender']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>お問い合わせ項目</label>
					<p><?php echo h($_POST['item']) ; ?></p>
				</div>
				<div class="form-input-item">
					<label>お問い合わせ内容</label>
					<p><?php echo h($_POST["content"]) ; ?></p>
				</div>
				
				<br>
				<input type="submit" name="btn_submit" value="送信" class="btn btn-primary mb-2">
				<input type="submit" name="back" value="戻る" class="btn btn-primary mb-2">
				
				<input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ; ?>">
				<!-- csrf対策 ページが入力→確認に変わるタイミングでcsrfの値が消えてしまうのでtype="hidden"のinputで値を保持させておく -->
				<input type="hidden" name="name" value="<?php echo h($_POST['name']) ; ?>">
				<input type="hidden" name="furigana" value="<?php echo h($_POST['furigana']) ; ?>">
				<input type="hidden" name="email" value="<?php echo h($_POST['email']) ; ?>">
				<input type="hidden" name="tel" value="<?php echo h($_POST['tel']) ; ?>">
				<input type="hidden" name="gender" value="<?php echo h($_POST['gender']) ; ?>">
				<input type="hidden" name="item" value="<?php echo h($_POST['item']) ; ?>">
				<input type="hidden" name="content" value="<?php echo h($_POST["content"]) ; ?>">
			</div>
				</div>
			</div>
			
		    <div class="footer">
            	<div class="footer-wrapper">
                	<a href="anken-mosha1.html" class="footer-logo">
                    	TECHMEETS<br>
                    	ダミーテキスト
                	</a>
     
                	<div class="responsive-footer-logo">
                    	<p>＠TECHMEETS DUMMY TEXT</p>
                	</div>
                
                	<div class="responsive-footer-text">
                    	<p>All Right Reserved.</p>
                	</div>
                
                	<div class="footer-list">
                    	<ul>
                        	<li>TOP</li>
							<li>カリキュラム</li>
                        	<li>料金</li>
                        	<li>アクセス</li>
                        	<li>無料相談</li>
                        	<li>お申込み</li>
                        	<li>プライバシーポリシー</li>
                    	</ul>
                	</div>    
            	</div>
        	</div>
		</form>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if($pageFlag === 2) : ?>
	<!-- 完了画面 -->
	<?php if($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
	<!-- csrf対策完了画面でも合言葉があってるかを確認する -->
            <!--<div class="header">-->
				<div class="header-image">
                <div class="header-wrapper">
                    <a href="anken-mosha1-form.php" class="header-logo">
                        TECHMEETS<br>
                        ダミーテキスト
                    </a>
                    <a href="#" class="header-icon" id="show">
                        <i class="fas fa-bars" ></i>
                    </a>

                    <div class="header-btn">
                        <a href="#" class="header-btn1">無料相談</a>
                        <a href="anken-mosha1-form.php" class="header-btn2">お問い合わせ</a>    
                    </div>
                    
                    <div class="header-list">
                        <ul>
                            <li>TOP</li>
                            <li>カリキュラム</li>
                            <li>料金</li>
                            <li>アクセス</li>
                        </ul>
                    </div>

                </div>
					<div class="clear"></div>
				<!--</div>-->

		<div id="cover"></div>
		
		<div id="menu">
			<i class="fa fa-times" id="hide"></i>
			<ul>
				<li>TOP</li>
				<li>カリキュラム</li>
				<li>料金</li>
				<li>アクセル</li>
				<li>無料相談</li>
				<li>お問い合わせ</li>
			</ul>
		</div>
        

	<!-- menu -->
	
	<script type="text/javascript">
	(function() {
		'use strict';
		
		var show = document.getElementById('show');
		var hide = document.getElementById('hide');
		
		show.addEventListener('click', function() {
			document.body.className ='menu-open';
		});
		
		hide.addEventListener('click', function() {
			document.body.className = '';
		});
	})();
	</script>	
				
            </div>
				<div class="thanks-form-group">
				<div class="thanks-form-group-wrapper">
					<h2>お問い合わせありがとうございました。</h2>
					<p>内容を確認のうえ、回答いたします。<br>
					しばらくお待ちください。</p>
	
					<a href="anken-mosha1-form.php">
						<input type="submit" name="buttom" value="お問い合わせに戻る" class="thanks-form-group-btn">
					</a>
				</div>
				</div>
	
	<?php unset($_SESSION['csrfToken']) ; ?>
	<!-- csrf対策 合言葉を削除する -->

		    <div class="footer">
            	<div class="footer-wrapper">
                	<a href="anken-mosha1.html" class="footer-logo">
                    	TECHMEETS<br>
                    	ダミーテキスト
                	</a>
                
                <div class="responsive-footer-logo">
                    <p>＠TECHMEETS DUMMY TEXT</p>
                </div>
                
                <div class="responsive-footer-text">
                    <p>All Right Reserved.</p>
                </div>
                
                <div class="footer-list">
                    <ul>
                        <li>TOP</li>
                        <li>カリキュラム</li>
                        <li>料金</li>
                        <li>アクセス</li>
                        <li>無料相談</li>
                        <li>お申込み</li>
                        <li>プライバシーポリシー</li>
                    </ul>
                </div>    
            	</div>
        	</div>
	<?php endif; ?>
	<?php endif; ?>
	
</body>
</html>
