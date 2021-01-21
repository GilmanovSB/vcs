
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <title>VCS</title>
</head>
<body>
<main class="main">
	<div class="main__container container">
		<div class="container__wrapper">
			<div class="card">
				
				<form class="card__form">
					<label for="tcID" class="card__label">
						<span class="card__label-text">ID TrueConf</span>
						<input required placeholder="Введите ID" type="text" id="tcID" name="login" class="card__input">
					</label>

					<label for="tcDisciples" class="card__label">
						<span class="card__label-text">Дисциплина</span>
						<input placeholder="Введите название дисциплины" type="text" id="tcDisciples" name="title" class="card__input">
					</label>

					<label for="tcTopic" class="card__label">
						<span class="card__label-text">Тема текущего занятия</span>
						<input placeholder="Введите тему занятия" type="text" id="tcTopic" name="description" class="card__input">
					</label>
					<div class="form__controls">
						<button type="submit" class="card__button btn btn--primary">Создать конференцию</button>

						
						</div>
				</form>
			</div>
		</div>
	</div>
</main>
<script src="src/main.js"></script>   
</body>
</html>


