<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CurrencyController extends CI_Controller
{
	public function index()
	{
		$this->load->view('calculator');
	}

	// takes 3 parameters and converts one currency to another
	public function convertCurrency($amount, $from_currency, $to_currency): string
	{
		if (!is_numeric($amount) || !ctype_alpha($from_currency) || !ctype_alpha($to_currency)) {
			return "Enter correct values";
		}

		$apikey = '400df89c9ea465ac6491';

		$from_Currency = urlencode(strtoupper($from_currency));
		$to_Currency = urlencode(strtoupper($to_currency));
		$query = "{$from_Currency}_{$to_Currency}";

		$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

		$obj = json_decode($json, true);

		$val = floatval($obj["$query"]);

		$total = $val * $amount;

		return number_format($total, 2, '.', '');

	}

	//takes 3 parameters and returns currency pairs value on a certain date in the past
	public function show($from_currency, $to_currency, $date)
	{
		if (!ctype_alpha($from_currency) || !ctype_alpha($to_currency)) {
			return "Enter correct values";
		}

		$apikey = '400df89c9ea465ac6491';

		$from_Currency = urlencode($from_currency);
		$to_Currency = urlencode($to_currency);
		$query = "{$from_Currency}_{$to_Currency}";

		$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&date={$date}&apiKey={$apikey}");

		$obj = json_decode($json, true);

		foreach ($obj as $value) {
			foreach ($value as $key) {
				return number_format($key, 2, '.', '');
			}
		}
	}
}


