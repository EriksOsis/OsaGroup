<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Currency converter</title>
	<style>
		.container {
			display: flex;
			justify-content: center;
		}

		h1 {
			text-align: center;
		}

		.calc-div, .curr-list {
			box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
			padding: 20px;
			background-color: #debe00;
			width: 500px;
			min-width: 300px;
			font-family: sans-serif;
			display: flex;
			flex-direction: column;
			gap: 10px;
			align-items: center;
			margin: 10px;
		}

		.calc-input, .list-input {
			width: 100%;
			height: 30px;
			border: none;
			box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
			border-radius: 4px;
			padding: 0 5px;
			margin-bottom: 10px;
		}

		:focus {
			outline: none;
		}

		.calc-btn, .list-btn {
			border: none;
			padding: 5px 15px;
			background-color: #5a87ea;
			border-radius: 4px;
			color: white;
			cursor: pointer;
			box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		}

		.calc-btn:hover {
			background-color: #4f78d2;
		}

		.list-btn:hover {
			background-color: #4f78d2;
		}

		.calc-btn:active {
			background-color: #496dbd;
		}

		.list-btn:active {
			background-color: #496dbd;
		}

		.calc-result, .date-result {
			background-color: white;
			width: 45%;
			height: 30px;
			border: none;
			box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
			border-radius: 4px;
			padding: 0px 0px;
			margin-bottom: 10px;
			display: flex;
			justify-content: center;
		}
	</style>
</head>
<body>
<section class="container">
	<div class="calc-div">
		<h1>Currency converter</h1>
		<div class="calc-result">
			<?php $conversion = new CurrencyController();
			if (isset($_POST["convert"])) {
				echo $conversion->convertCurrency($_POST["amount"], $_POST["from_currency"], $_POST["to_currency"]);
			}
			?>

		</div>
		<form action="" method="POST">
			<div class="amount-container">
				<label for="curr-amount">Amount</label>
				<input type="number" id="curr-amount" name="amount" class="calc-input">
			</div>

			<div class="calc-from-container">
				<label for="curr-from">From</label>
				<input type="text" id="curr-from" name="from_currency" class="calc-input">
			</div>

			<div class="calc-to-container">
				<label for="curr-to">To</label>
				<input type="text" id="curr-to" name="to_currency" class="calc-input">
			</div>

			<div class="calc-btn-container">
				<button type="submit" name="convert" class="calc-btn">Convert</button>
			</div>
		</form>
	</div>

	<div class="curr-list">
		<h1>Currency list</h1>
		<div class="date-result">
			<?php $showDate = new CurrencyController();
			if (isset($_POST["date-submit"])) {
				echo $showDate->show($_POST["list-base"], $_POST["list-quote"], $_POST["curr-list-date"]).
				strtoupper(" {$_POST["list-base"]}{$_POST["list-quote"]}");
			}
			?>

		</div>
		<form action="" method="post">
			<div class="list-base-curr">
				<label for="curr-base">Base currency</label>
				<input type="text" id="curr-base" name="list-base" class="list-input">
			</div>

			<div class="list-quote-curr">
				<label for="curr-quote">Quote currency</label>
				<input type="text" id="curr-quote" name="list-quote" class="list-input">
			</div>

			<div class="date">
				<label for="curr-date">Choose a date</label>
				<input type="date" id="curr-date" name="curr-list-date" max="" class="list-input">
			</div>
			<div class="date-btn">
				<button type="submit" name="date-submit" class="list-btn">Show</button>
			</div>
		</form>
	</div>
</section>
</body>
</html>

<script>
	let today = new Date();
	let dd = today.getDate();
	let mm = today.getMonth() + 1;
	const yyyy = today.getFullYear();

	if (dd < 10) {
		dd = '0' + dd;
	}

	if (mm < 10) {
		mm = '0' + mm;
	}

	today = yyyy + '-' + mm + '-' + dd;
	document.getElementById("curr-date").setAttribute("max", today);
</script>
